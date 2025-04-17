// composables/useCart.js
import { defineStore } from "pinia";
import { computed } from "vue";

export const useCartStore = defineStore("cart", {
    state: () => ({
        cart: JSON.parse(localStorage.getItem("cart")) || [],
    }),
    actions: {
        addToCart(product, count = 1) {
            if (parseInt(count, 10) < 1) count = 1;

            const existingItem = this.cart.find(
                (item) => item.id === product.id
            );

            if (existingItem) {
                existingItem.quantity += count;
            } else {
                this.cart.push({
                    ...product,
                    quantity: count,
                });
            }
            this.saveCart();
        },
        removeFromCart(productId) {
            this.cart = this.cart.filter((item) => item.id !== productId);

            this.saveCart();
        },
        updateQuantity(productId, newQuantity) {
            const item = this.cart.find((item) => item.id === productId);
            if (item) {
                item.quantity = Math.max(1, newQuantity);
                this.saveCart();
            }
        },
        clearCart() {
            this.cart = [];
            this.saveCart();
        },
        saveCart() {
            localStorage.setItem("cart", JSON.stringify(this.cart));
        },
    },
    getters: {
        cartTotal: (state) => {
            return state.cart.reduce((total, item) => {
                return total + item.price * item.quantity;
            }, 0);
        },
        cartItemCount: (state) => {
            return state.cart.reduce((count, item) => {
                return count + item.quantity;
            }, 0);
        },
    },
});

// Usage in a component
// import { useCartStore } from 'path/to/useCart';
