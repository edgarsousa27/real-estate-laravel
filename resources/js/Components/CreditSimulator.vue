<template>
    <div class="bg-white shadow-lg rounded-lg p-6 md:p-8 lg:p-10 space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-blue-500">
                Simulador de crédito
            </h1>
        </div>

        <div class="space-y-4">
            <div>
                <InputLabel for="propertyValue" value="Valor do imóvel" />
                <p class="w-full">
                    {{ formatPrice(props.properties.price) + "€" }}
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <InputLabel
                        for="downPaymentValue"
                        value="Valor de entrada"
                    />
                    <TextInput
                        type="number"
                        id="downPaymentValue"
                        class="w-full"
                        v-model="downPaymentValue"
                    />
                </div>
                <div>
                    <InputLabel for="downPaymentPercent" value="% de entrada" />
                    <TextInput
                        type="number"
                        id="downPaymentPercent"
                        class="w-full"
                        min="10"
                        max="100"
                        v-model="downPaymentPercent"
                    />
                </div>
            </div>

            <div>
                <InputLabel
                    for="amortizationPeriod"
                    value="Prazo de Amortização (anos)"
                />
                <div class="flex items-center space-x-4">
                    <input
                        type="range"
                        id="amortizationPeriod"
                        min="10"
                        max="40"
                        class="w-full"
                        v-model="amortizationPeriod"
                    />
                    <span class="text-gray-700 min-w-[40px]">
                        {{ amortizationPeriod }} anos
                    </span>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200">
                <h2 class="text-lg font-semibold">Prestação Mensal</h2>
                <p class="text-2xl font-bold text-blue-500">
                    {{ monthlyPayment }} €
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref, watch, computed } from "vue";

const props = defineProps({
    properties: Object,
});

const downPaymentValue = ref(0);
const downPaymentPercent = ref(10);
const amortizationPeriod = ref(30);

watch(downPaymentPercent, (newVal) => {
    downPaymentValue.value = (props.properties.price * newVal) / 100;
});

watch(downPaymentValue, (newVal) => {
    downPaymentPercent.value = (newVal / props.properties.price) * 100;
});

const monthlyPayment = computed(() => {
    const loanAmount = props.properties.price - downPaymentValue.value;
    const months = amortizationPeriod.value * 12;
    const annualInterestRate = 0.036;
    const monthlyRate = annualInterestRate / 12;

    const payment =
        (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months)) /
        (Math.pow(1 + monthlyRate, months) - 1);

    return payment.toFixed(2);
});

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};
</script>
