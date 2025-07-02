<template>
    <div v-if="form.category_id == 1 || form.category_id == 2">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            <!-- Garage -->
            <div>
                <Checkbox
                    id="garage"
                    :value="true"
                    v-model:checked="form.garage"
                    class="hidden peer"
                />
                <label
                    for="garage"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="warehouse" class="w-4 h-4 mr-2" />
                    <span>{{ t("properties-form.garage") }}</span>
                </label>
            </div>

            <!-- Heating -->
            <div>
                <Checkbox
                    id="heating"
                    :value="true"
                    v-model:checked="form.heating"
                    class="hidden peer"
                />
                <label
                    for="heating"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon
                        icon="temperature-high"
                        class="w-4 h-4 mr-2"
                    />
                    <span>{{ t("properties-form.heating") }}</span>
                </label>
            </div>

            <!-- Cooling -->
            <div>
                <Checkbox
                    id="cooling"
                    :value="true"
                    v-model:checked="form.cooling"
                    class="hidden peer"
                />
                <label
                    for="cooling"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="snowflake" class="w-4 h-4 mr-2" />
                    <span>{{ t("properties-form.cooling") }}</span>
                </label>
            </div>

            <!-- Kitchen Equipped -->
            <div>
                <Checkbox
                    id="kitchen_equipped"
                    :value="true"
                    v-model:checked="form.kitchen_equipped"
                    class="hidden peer"
                />
                <label
                    for="kitchen_equipped"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon
                        icon="kitchen-set"
                        class="w-4 h-4 mr-2"
                    />
                    <span>{{ t("properties-form.kitchen_equipped") }}</span>
                </label>
            </div>

            <!--Double glazing-->
            <div>
                <Checkbox
                    id="double_glazing"
                    :value="true"
                    v-model:checked="form.double_glazing"
                    class="hidden peer"
                />
                <label
                    for="double_glazing"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="clone" class="w-4 h-4 mr-2" />
                    {{ t("properties-form.double_glazing") }}</label
                >
            </div>
            <!--Security Alarm System-->
            <div>
                <Checkbox
                    id="security_alarm_system"
                    :value="true"
                    v-model:checked="form.security_alarm_system"
                    class="hidden peer"
                />
                <label
                    for="security_alarm_system"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon
                        icon="shield-halved"
                        class="w-4 h-4 mr-2"
                    />
                    {{ t("properties-form.security_alarm_system") }}</label
                >
            </div>
            <!--Fire Alarm System-->
            <div>
                <Checkbox
                    id="fire_alarm_system"
                    :value="true"
                    v-model:checked="form.fire_alarm_system"
                    class="hidden peer"
                />
                <label
                    for="fire_alarm_system"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="fire" class="w-4 h-4 mr-2" />
                    {{ t("properties-form.fire_alarm_system") }}</label
                >
            </div>
            <!--Garden-->
            <div>
                <Checkbox
                    id="garden"
                    :value="true"
                    v-model:checked="form.garden"
                    class="hidden peer"
                />
                <label
                    for="garden"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="tree" class="w-4 h-4 mr-2" />
                    {{ t("properties-form.garden") }}</label
                >
            </div>
            <!--Balcony-->
            <div>
                <Checkbox
                    id="balcony"
                    :value="true"
                    v-model:checked="form.balcony"
                    class="hidden peer"
                />
                <label
                    for="balcony"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 91.18 77.2"
                        width="24"
                        height="24"
                        class="w-4 h-4 mr-2"
                    >
                        <path
                            class="cls-1"
                            d="M89.18,61.39h-.3v-22a2,2,0,0,0-2-2H80.35a2,2,0,0,0-2,2v.43h-10V2a2,2,0,0,0-2-2H24.1a2,2,0,0,0-2,2V39.87H12.89v-.43a2,2,0,0,0-2-2H4.36a2,2,0,0,0-2,2v22H2a2,2,0,0,0-2,2V75.2a2,2,0,0,0,2,2H89.18a2,2,0,0,0,2-2V63.39A2,2,0,0,0,89.18,61.39Zm-6.83-20h2.53v20H82.35v-20Zm-4,20h-11V43.87h11ZM25.11,43.87H37.2V61.39H25.11Zm14.09,0H51.29V61.39H39.2Zm14.09,0H65.38V61.39H53.29Zm-7-4V22.93H64.38V39.87ZM64.38,20.93H46.24V4H64.38ZM44.24,4V20.93H26.1V4ZM26.1,22.93H44.24V39.87H26.1Zm-3,20.94V61.39H12.89V43.87ZM6.36,41.44H8.89v20H6.36ZM87.18,73.2H4V65.39H87.18Z"
                        ></path>
                    </svg>
                    {{ t("properties-form.balcony") }}</label
                >
            </div>
            <!--Terrace-->
            <div>
                <Checkbox
                    id="terrace"
                    :value="true"
                    v-model:checked="form.terrace"
                    class="hidden peer"
                />
                <label
                    for="terrace"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="sun" class="w-4 h-4 mr-2" />
                    {{ t("properties-form.terrace") }}</label
                >
            </div>
            <!--Solar panels-->
            <div>
                <Checkbox
                    id="solar_panels"
                    :value="true"
                    v-model:checked="form.solar_panels"
                    class="hidden peer"
                />
                <label
                    for="solar_panels"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon
                        icon="solar-panel"
                        class="w-4 h-4 mr-2"
                    />
                    {{ t("properties-form.solar_panels") }}</label
                >
            </div>
            <!--Thermal Insulation-->
            <div>
                <Checkbox
                    id="thermal_insulation"
                    :value="true"
                    v-model:checked="form.thermal_insulation"
                    class="hidden peer"
                />
                <label
                    for="thermal_insulation"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon
                        icon="house-chimney"
                        class="w-4 h-4 mr-2"
                    />
                    {{ t("properties-form.thermal_insulation") }}</label
                >
            </div>
            <!--Fireplace-->
            <div>
                <Checkbox
                    id="fireplace"
                    :value="true"
                    v-model:checked="form.fireplace"
                    class="hidden peer"
                />
                <label
                    for="fireplace"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon
                        icon="fire-burner"
                        class="w-4 h-4 mr-2"
                    />
                    {{ t("properties-form.fireplace") }}
                </label>
            </div>
            <!--Storage-->
            <div>
                <Checkbox
                    id="storage"
                    :value="true"
                    v-model:checked="form.storage"
                    class="hidden peer"
                />
                <label
                    for="storage"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="jar-wheat" class="w-4 h-4 mr-2" />
                    {{ t("properties-form.storage") }}
                </label>
            </div>
            <!--Swimming Pool-->
            <div>
                <Checkbox
                    id="swimming_pool"
                    :value="true"
                    v-model:checked="form.swimming_pool"
                    class="hidden peer"
                />
                <label
                    for="swimming_pool"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon
                        icon="water-ladder"
                        class="w-4 h-4 mr-2"
                    />
                    {{ t("properties-form.swimming_pool") }}
                </label>
            </div>
            <!--Sea view-->
            <div>
                <Checkbox
                    id="sea_view"
                    :value="true"
                    v-model:checked="form.sea_view"
                    class="hidden peer"
                />
                <label
                    for="sea_view"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="water" class="w-4 h-4 mr-2" />
                    {{ t("properties-form.sea_view") }}
                </label>
            </div>
            <!--Mountain view-->
            <div>
                <Checkbox
                    id="mountain_view"
                    :value="true"
                    v-model:checked="form.mountain_view"
                    class="hidden peer"
                />
                <label
                    for="mountain_view"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon
                        icon="mountain-sun"
                        class="w-4 h-4 mr-2"
                    />
                    {{ t("properties-form.mountain_view") }}
                </label>
            </div>
            <!--Smart home-->
            <div>
                <Checkbox
                    id="smart_home"
                    :value="true"
                    v-model:checked="form.smart_home"
                    class="hidden peer"
                />
                <label
                    for="smart_home"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon
                        icon="house-signal"
                        class="w-4 h-4 mr-2"
                    />
                    {{ t("properties-form.smart_home") }}
                </label>
            </div>
            <!--Furnished-->
            <div>
                <Checkbox
                    id="furnished"
                    :value="true"
                    v-model:checked="form.furnished"
                    class="hidden peer"
                />
                <label
                    for="furnished"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="couch" class="w-4 h-4 mr-2" />
                    {{ t("properties-form.furnished") }}
                </label>
            </div>
            <!--Building pool-->
            <div>
                <Checkbox
                    id="building_pool"
                    :value="true"
                    v-model:checked="form.building_pool"
                    class="hidden peer"
                />
                <label
                    for="building_pool"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon
                        icon="water-ladder"
                        class="w-4 h-4 mr-2"
                    />
                    {{ t("properties-form.building_pool") }}
                </label>
            </div>
            <!--Building gym-->
            <div>
                <Checkbox
                    id="building_gym"
                    :value="true"
                    v-model:checked="form.building_gym"
                    class="hidden peer"
                />
                <label
                    for="building_gym"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="dumbbell" class="w-4 h-4 mr-2" />
                    {{ t("properties-form.building_gym") }}
                </label>
            </div>
            <!--Wheelchair access-->
            <div>
                <Checkbox
                    id="wheelchair_access"
                    :value="true"
                    v-model:checked="form.wheelchair_access"
                    class="hidden peer"
                />
                <label
                    for="wheelchair_access"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="wheelchair" class="w-4 h-4 mr-2" />
                    {{ t("properties-form.wheelchair_access") }}
                </label>
            </div>
            <!--Elevator-->
            <div>
                <Checkbox
                    id="elevator"
                    :value="true"
                    v-model:checked="form.elevator"
                    class="hidden peer"
                />
                <label
                    for="elevator"
                    class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer transition-colors hover:bg-gray-100 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-500"
                >
                    <font-awesome-icon icon="elevator" class="w-4 h-4 mr-2" />
                    {{ t("properties-form.elevator") }}
                </label>
            </div>
        </div>
    </div>
</template>

<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    form: Object,
    checked: [Array, Boolean],
});
</script>
