<template>
    <form @submit.prevent="submit">
        <label for="first_name">Categoria</label>
        <select name="category_id" v-model="form.category_id">
            <option :value="1">Casa</option>
            <option :value="2">Apartamento</option>
            <option :value="3">Terreno</option>
        </select>
        <label for="transaction">Transação</label>
        <select name="transaction_id" v-model="form.transaction_id">
            <option :value="1">Vender</option>
            <option :value="2">Alugar</option>
        </select>
        <label for="">Descrição</label>
        <input type="text" v-model="form.description" />
        <label for="">Morada</label>
        <input type="text" v-model="form.address" />
        <label for="">Preço</label>
        <input type="number" v-model="form.price" />
        <label for="">M2</label>
        <input type="number" v-model="form.square_meters" />
        <label for="">Cidade</label>
        <input type="text" v-model="form.city" />
        <button type="submit">Submit</button>
    </form>
</template>

<script setup>
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";

defineProps({
    properties: [Array, Object],
});

const form = reactive({
    category_id: null,
    transaction_id: null,
    description: "",
    address: "",
    price: null,
    square_meters: null,
    city: "",
});

function submit() {
    router.post(route("properties.store"), form);
}
</script>
