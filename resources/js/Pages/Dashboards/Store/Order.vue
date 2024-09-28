<script setup>
import SearchInput from "../../../Components/SearchInput.vue";
import InputError from "../../../Components/InputError.vue";

defineProps({
    orders: Array
})

const url = window.location.pathname;
</script>

<template>
    <div class="container">
        <div class="row my-2">
            <div class="col-6">
                <form>
                    <SearchInput name="order_filter" />
                </form>
            </div>

        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Store ID</th>
                    <th scope="col">Billing Address</th>
                    <th scope="col">Shipping Address</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Status</th>
                    <th scope="col">Products Price</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Control</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="order in orders.data" :key="order.id">
                    <th scope="row">{{ order.id }}</th>
                    <td>{{ order.user_id }}</td>
                    <td>{{ order.store_id }}</td>
                    <td>{{ order.billing_address }}</td>
                    <td>{{ order.shipping_address }}</td>
                    <td>{{ order.payment_method }}</td>
                    <td>{{ order.payment_status }}</td>
                    <td>{{ order.status }}</td>
                    <td>{{ order.products_price }}</td>
                    <td>{{ new Date(order.created_at).toLocaleString() }}</td>
                    <td>
                        <a :href="`${url}/${order.id}/update`" class="btn btn-outline-primary">Edit</a>
                        <button class="btn ms-2 btn-outline-danger">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>
.fs-10 {
    font-size: 12px;
}
</style>
