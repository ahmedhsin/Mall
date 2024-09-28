<script setup>
// Assuming the `orders` data is passed from the parent or fetched from an API
defineProps({
    orders: Object // The paginated orders data
});
</script>

<template>
    <div class="orders-container my-5">
        <h2>Your Orders</h2>

        <div v-if="orders.data.length === 0" class="empty-orders">
            <p>No orders found.</p>
        </div>

        <div v-else class="order-list">
            <div v-for="order in orders.data" :key="order.id" class="order-item p-3 mb-3 border rounded-3 shadow-sm">
                <h4>Order #{{ order.id }}</h4>
                <p><strong>Billing Address:</strong> {{ order.billing_address }}</p>
                <p><strong>Shipping Address:</strong> {{ order.shipping_address }}</p>
                <p><strong>Payment Method:</strong> {{ order.payment_method }}</p>
                <p><strong>Payment Status:</strong> {{ order.payment_status }}</p>
                <p><strong>Order Status:</strong> {{ order.status }}</p>
                <p><strong>Products Price:</strong> ${{ order.products_price }}</p>
                <p><strong>Notes:</strong> {{ order.notes }}</p>
                <p><strong>Order Date:</strong> {{ new Date(order.created_at).toLocaleString() }}</p>

                <!-- Button to go to the order details page -->
                <a :href="`/orders/${order.id}`" class="btn btn-dark mt-2">View Order</a>
            </div>
        </div>

        <!-- Pagination links -->
        <nav v-if="orders.total > orders.per_page" aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item" :class="{ disabled: !orders.prev_page_url }">
                    <a class="page-link" :href="orders.prev_page_url">Previous</a>
                </li>

                <li class="page-item" :class="{ active: orders.current_page === pageNumber }" v-for="pageNumber in orders.last_page" :key="pageNumber">
                    <a class="page-link" :href="`${orders.path}?page=${pageNumber}`">{{ pageNumber }}</a>
                </li>

                <li class="page-item" :class="{ disabled: !orders.next_page_url }">
                    <a class="page-link" :href="orders.next_page_url">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<style scoped>
.orders-container {
    max-width: 800px;
    margin: 0 auto;
}

.order-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.order-item {
    background-color: #f8f9fa;
}

.order-item h4 {
    margin-bottom: 10px;
}

.empty-orders {
    text-align: center;
    font-size: 1.25rem;
    margin-top: 2rem;
}

.pagination {
    margin-top: 2rem;
}
</style>
