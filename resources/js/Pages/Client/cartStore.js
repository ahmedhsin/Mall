import { reactive, watch } from "vue";

const storedCart = JSON.parse(localStorage.getItem("cart")) || {
    items: []
};

const cart = reactive(storedCart);

const addToCart = (product) => {
    const existingProduct = cart.items.find((item) => item.id === product.id);
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.items.push({
            id: product.id,
            name: product.name,
            price: product.price,
            image: product.images[0]?.name,
            quantity: 1
        });
    }
    console.log(cart.items)
};

const removeFromCart = (productId) => {
    const index = cart.items.findIndex((item) => item.id === productId);
    if (index !== -1) {
        cart.items.splice(index, 1);
    }
};
const clearCart = () => {
    cart.items = [];
}
watch(
    () => cart.items,
    (newItems) => {
        localStorage.setItem("cart", JSON.stringify(cart));
    },
    { deep: true }
);

export { cart, addToCart, removeFromCart, clearCart };
