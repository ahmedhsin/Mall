<script setup>
import { Link } from "@inertiajs/vue3";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";
import { useForm } from '@inertiajs/vue3';
import Message from "../../Components/Message.vue";
import { cart, clearCart } from "../Client/cartStore.js";

const form = useForm({
    billing_address: null,
    payment_method: null,
    shipping_address: null,
    notes: null,
    products_price: cart.items.reduce((total, item) => total + item.price * item.quantity, 0),
    products_ids: cart.items.map(item => ({
        id: item.id,
        quantity: item.quantity
    })),
});

const submitForm = () => {
    form.post(route('checkout.store'), {
        onSuccess: () => {
            clearCart();
            form.reset();
        }
    });
}
</script>

<template>
    <form @submit.prevent="submitForm" class="my-5 p-4 row shadow-lg w-75 rounded-4 g-3 mx-auto align-items-center">
        <Message :message="$page.props.messages" />
        <div class="col-12">
            <InputLabel value="Billing Address" for="billing_address" />
            <textarea v-model="form.billing_address" id="notes" class="form-control" rows="4" required></textarea>            <InputError :message="form.errors.billing_address" />
        </div>

        <div class="col-12">
            <InputLabel value="Shipping Address" for="shipping_address" />
            <textarea v-model="form.shipping_address" id="notes" class="form-control" rows="4" required></textarea>            <InputError :message="form.errors.shipping_address" />
        </div>

        <div class="col-12">
            <InputLabel value="Payment Method" for="payment_method" />
            <select v-model="form.payment_method" id="payment_method" class="form-select" required>
                <option value="" disabled>Select a payment method</option>
                <option value="credit_card" selected>Credit Card</option>
                <option value="paypal" disabled>PayPal</option>
                <option value="bank_transfer" disabled>Bank Transfer</option>
            </select>
            <InputError :message="form.errors.payment_method" />
        </div>

        <div class="col-12">
            <InputLabel value="Notes" for="notes" />
            <textarea v-model="form.notes" id="notes" class="form-control" rows="4"></textarea>
            <InputError :message="form.errors.notes" />
        </div>

        <div class="col-12">
            <h5 class="mt-4">Order Summary</h5>
            <p><strong>Total Products Price:</strong> ${{ form.products_price.toFixed(2) }}</p>
        </div>

        <div class="col-12">
            <button type="submit" class="w-100 btn btn-primary" :disabled="form.processing">Complete Checkout</button>
        </div>
    </form>
</template>

<style scoped>
</style>
