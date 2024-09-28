<script setup>
import {onMounted, ref} from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from "../../../Components/InputLabel.vue";
import InputError from "../../../Components/InputError.vue";
import TextInput from "../../../Components/TextInput.vue";
import Message from "../../../Components/Message.vue";

let {product} = defineProps({
    errors: Object,
    product: Object,
    categories: Object
});
const form = useForm({
    en_name: product.data.en_name,
    en_description: product.data.en_description,
    ar_name: product.data.ar_name,
    ar_description: product.data.ar_description,
    price: product.data.price,
    stock: product.data.stock,
    status: product.data.status,
    sku: product.data.sku,
    weight: product.data.weight,
    dimensions: product.data.dimensions,
    featured: product.data.featured,
    en_brand: product.data.en_brand,
    ar_brand: product.data.ar_brand,
    categories: [],
    images: [],
    ImagesToDelete: []
});
const oldImages = product.data.images;
const imagePreviews = ref([]); // To store image preview URLs

const handleImageChange = (event) => {
    const files = Array.from(event.target.files);
    form.images = files; // Update the form with selected images
    imagePreviews.value = files.map(file => URL.createObjectURL(file)); // Create image preview URLs
};



const submitForm = () => {
    form.post(window.location.pathname, {
        onSuccess: () => {
            form.reset();
            imagePreviews.value = [];
        }
    });
};

const categoriesEl = ref();
onMounted(() => {
    const selectedCategories = product.data.categories.map(cat => cat.id);
    Array.from(categoriesEl.value.options).forEach(option => {
        if (selectedCategories.includes(parseInt(option.value))) {
            option.selected = true;
        } else {
            option.selected = false;
        }
    });
    form.categories = selectedCategories;
})

</script>
<template>
    <form @submit.prevent="submitForm" class="my-5 p-3 row shadow-lg w-75 rounded-4 g-3 mx-auto align-items-center">
        <InputError :message="errors.error"/>
        <Message :message="$page.props.messages" />

        <!-- English and Arabic Name Fields -->
        <div class="col-12 col-md-6">
            <InputLabel value="Name in English" for="en_name"/>
            <TextInput v-model="form.en_name" id="en_name" type="text" required />
            <InputError :message="form.errors.en_name"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Name in Arabic" for="ar_name"/>
            <TextInput v-model="form.ar_name" id="ar_name" type="text" required />
            <InputError :message="form.errors.ar_name"/>
        </div>

        <div v-if="imagePreviews.length" class="col-12 col-md-6 mb-3">
            <div class="d-flex flex-wrap gap-3">
                <img v-for="(preview, index) in imagePreviews" :key="index" :src="preview" class="img-thumbnail" alt="Selected image" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
        </div>
        <!-- Image Upload Input -->
        <div class="col-12">
            <InputLabel value="Upload Images" for="images" />
            <input @change="handleImageChange" id="images" type="file" multiple class="form-control" />
            <InputError :message="form.errors.images" />
        </div>

        <!-- Description Fields -->
        <div class="col-12 col-md-6">
            <InputLabel value="Description in English" for="en_description"/>
            <textarea class="form-control" v-model="form.en_description" id="en_description" type="text" />
            <InputError :message="form.errors.en_description"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Description in Arabic" for="ar_description"/>
            <textarea class="form-control" v-model="form.ar_description" id="ar_description" type="text" />
            <InputError :message="form.errors.ar_description"/>
        </div>

        <!-- Price, Stock, Status, SKU, Weight, Dimensions -->
        <div class="col-12 col-md-6">
            <InputLabel value="Price" for="price"/>
            <TextInput v-model="form.price" id="price" type="number" required />
            <InputError :message="form.errors.price"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Stock" for="stock"/>
            <TextInput v-model="form.stock" id="stock" type="number" required />
            <InputError :message="form.errors.stock"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Status" for="status"/>
            <select v-model="form.status" id="status" class="form-control" required>
                <option value="active" selected>Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <InputError :message="form.errors.status"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="SKU" for="sku"/>
            <TextInput v-model="form.sku" id="sku" type="text" required />
            <InputError :message="form.errors.sku"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Weight" for="weight"/>
            <TextInput v-model="form.weight" id="weight" type="number" required />
            <InputError :message="form.errors.weight"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Dimensions" for="dimensions"/>
            <TextInput v-model="form.dimensions" id="dimensions" type="text" required />
            <InputError :message="form.errors.dimensions"/>
        </div>

        <!-- Brand Fields (English and Arabic) -->
        <div class="col-12 col-md-6">
            <InputLabel value="Brand in English" for="en_brand"/>
            <TextInput v-model="form.en_brand" id="en_brand" type="text" required />
            <InputError :message="form.errors.en_brand"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Brand in Arabic" for="ar_brand"/>
            <TextInput v-model="form.ar_brand" id="ar_brand" type="text" required />
            <InputError :message="form.errors.ar_brand"/>
        </div>

        <!-- Featured Checkbox -->
        <div class="col-12 col-md-6">
            <InputLabel value="Featured" for="featured"/>
            <input class="ms-2" type="checkbox" v-model="form.featured" id="featured" />
            <InputError :message="form.errors.featured"/>
        </div>

        <!-- Categories (Multiple Select) -->
        <div class="col-12 col-md-6">
            <InputLabel value="Categories" for="categories"/>
            <select ref="categoriesEl" v-model="form.categories" id="categories" multiple class="form-control">
                <option v-for="category in categories.data" :key="category" :value="category['id']">{{ category['name'] }}</option>
            </select>
            <InputError :message="form.errors.categories"/>
        </div>

        <!-- Submit Button -->
        <div class="col-12">
            <button type="submit" class="w-100 btn btn-primary btn-dark" :disabled="form.processing">Add Product</button>
        </div>
    </form>
</template>

<style scoped>
.img-thumbnail {
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
</style>
