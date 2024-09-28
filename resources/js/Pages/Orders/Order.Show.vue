<script setup>
defineProps({
    order: Object // Expect the 'order' object to be passed as a prop
});
</script>

<template>
    <div class="order-details-container my-5">
        <h2>Order #{{ order.data.id }} Details</h2>

        <!-- Order Information -->
        <div class="order-info mb-4">
            <p><strong>Billing Address:</strong> {{ order.data.billing_address }}</p>
            <p><strong>Shipping Address:</strong> {{ order.data.shipping_address }}</p>
            <p><strong>Payment Method:</strong> {{ order.data.payment_method }}</p>
            <p><strong>Payment Status:</strong> {{ order.data.payment_status }}</p>
            <p><strong>Order Status:</strong> {{ order.data.status }}</p>
            <p><strong>Notes:</strong> {{ order.data.notes }}</p>
            <p><strong>Order Date:</strong> {{ new Date(order.data.created_at).toLocaleString() }}</p>
            <p><strong>Total Products Price:</strong> ${{ order.data.products_price }}</p>
        </div>

        <!-- Products in the Order -->
        <h3>Products</h3>
        <div v-if="order.data.products.length === 0" class="empty-products">
            <p>No products found for this order.data.</p>
        </div>
        <div v-else class="products-list">
            <div v-for="product in order.data.products" :key="product.id" class="product-item p-3 mb-3 border rounded-3 shadow-sm">
                <h4>{{ product.name }}</h4>
                <p><strong>Brand:</strong> {{ product.brand }}</p>
                <p><strong>Price:</strong> ${{ product.price }}</p>
                <p><strong>Weight:</strong> {{ product.weight }}g</p>
                <p><strong>Dimensions:</strong> {{ product.dimensions }}</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.order-details-container {
    max-width: 800px;
    margin: 0 auto;
}

.order-info p {
    margin: 0.5rem 0;
}

.product-item h4 {
    margin-bottom: 10px;
}

.products-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
</style>
