<?php

namespace App\Http\Controllers\Store;

use App\Action\HandelMultiLangDataEncode;
use App\Events\SaveStoreEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $repo;
    public function __construct(StoreRepository $repo)
    {
        $this->repo = $repo;
    }
    public function index()
    {
        return StoreResource::collection($this->repo->getAllPaginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormRequest $request)
    {
        $data = $request->validated();

        $data = HandelMultiLangDataEncode::handel($data, Store::$multiLangColumns);
        DB::beginTransaction();
        event(new SaveStoreEvent($this->repo,$data));
        DB::commit();
        return StoreResource::make($this->repo->getOne('email', $data['email']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $store = $this->repo->getOne('id', $id);
        $canEdit = auth()->user()->can('update', $store);
        return [
            'store' => StoreResource::make($store),
            'canEdit' => $canEdit
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFormRequest $request, string $id)
    {
        $data = $request->validated();
        $data = HandelMultiLangDataEncode::handel($data, Store::$multiLangColumns);
        $data['id'] =$id;
        DB::beginTransaction();
        event(new SaveStoreEvent($this->repo,$data));
        DB::commit();
        return StoreResource::make($this->repo->getOne('email', $data['email']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
