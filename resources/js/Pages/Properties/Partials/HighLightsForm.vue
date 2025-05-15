<template>
    <div v-if="form.category_id == 1 || form.category_id == 2">
        <div class="space-y-3">
            <!--Kitchen-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="kitchen"
                    :value="true"
                    v-model:checked="form.kitchen"
                />
                <InputLabel
                    for="kitchen"
                    :value="t('properties-form.kitchen')"
                />
            </div>
            <!--Garage-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="garage"
                    :value="true"
                    v-model:checked="form.garage"
                />
                <InputLabel for="garage" :value="t('properties-form.garage')" />
            </div>

            <!-- Heating -->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="heating"
                    :value="true"
                    v-model:checked="form.heating"
                />
                <InputLabel
                    for="heating"
                    :value="t('properties-form.heating')"
                />
            </div>
            <!-- Cooling -->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="cooling"
                    :value="true"
                    v-model:checked="form.cooling"
                />
                <InputLabel
                    for="cooling"
                    :value="t('properties-form.cooling')"
                />
            </div>

            <!-- Kitchen Equipped -->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="kitchen_equipped"
                    :value="true"
                    v-model:checked="form.kitchen_equipped"
                />
                <InputLabel
                    for="kitchen_equipped"
                    :value="t('properties-form.kitchen_equipped')"
                />
            </div>
            <!--Double glazing-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="double_glazing"
                    :value="true"
                    v-model:checked="form.double_glazing"
                />
                <InputLabel
                    for="double_glazing"
                    :value="t('properties-form.double_glazing')"
                />
            </div>
            <!--Security Alarm System-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="security_alarm_system"
                    :value="true"
                    v-model:checked="form.security_alarm_system"
                />
                <InputLabel
                    for="security_alarm_system"
                    :value="t('properties-form.security_alarm_system')"
                />
            </div>
            <!--Fire Alarm System-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="fire_alarm_system"
                    :value="true"
                    v-model:checked="form.fire_alarm_system"
                />
                <InputLabel
                    for="fire_alarm_system"
                    :value="t('properties-form.fire_alarm_system')"
                />
            </div>
            <!--Garden-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="garden"
                    :value="true"
                    v-model:checked="form.garden"
                />
                <InputLabel for="garden" :value="t('properties-form.garden')" />
            </div>
            <!--Balcony-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="balcony"
                    :value="true"
                    v-model:checked="form.balcony"
                />
                <InputLabel
                    for="balcony"
                    :value="t('properties-form.balcony')"
                />
            </div>
            <!--Terrace-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="terrace"
                    :value="true"
                    v-model:checked="form.terrace"
                />
                <InputLabel
                    for="balcony"
                    :value="t('properties-form.terrace')"
                />
            </div>
            <!--Solar panels-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="solar_panels"
                    :value="true"
                    v-model:checked="form.solar_panels"
                />
                <InputLabel
                    for="solar_panels"
                    :value="t('properties-form.solar_panels')"
                />
            </div>
            <!--Thermal Insulation-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="thermal_insulation"
                    :value="true"
                    v-model:checked="form.thermal_insulation"
                />
                <InputLabel
                    for="thermal_insulation"
                    :value="t('properties-form.thermal_insulation')"
                />
            </div>
            <!--Fireplace-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="fireplace"
                    :value="true"
                    v-model:checked="form.fireplace"
                />
                <InputLabel
                    for="fireplace"
                    :value="t('properties-form.fireplace')"
                />
            </div>
            <!--Storage-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="storage"
                    :value="true"
                    v-model:checked="form.storage"
                />
                <InputLabel
                    for="storage"
                    :value="t('properties-form.storage')"
                />
            </div>
            <!--Swimming Pool-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="swimming_pool"
                    :value="true"
                    v-model:checked="form.swimming_pool"
                />
                <InputLabel
                    for="swimming_pool"
                    :value="t('properties-form.swimming_pool')"
                />
            </div>
            <!--Sea view-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="sea_view"
                    :value="true"
                    v-model:checked="form.sea_view"
                />
                <InputLabel
                    for="sea_view"
                    :value="t('properties-form.sea_view')"
                />
            </div>
            <!--Mountain view-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="mountain_view"
                    :value="true"
                    v-model:checked="form.mountain_view"
                />
                <InputLabel
                    for="mountain_view"
                    :value="t('properties-form.mountain_view')"
                />
            </div>
            <!--Open plan kitchen-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="open_plan_kitchen"
                    :value="true"
                    v-model:checked="form.open_plan_kitchen"
                />
                <InputLabel
                    for="open_plan_kitchen"
                    :value="t('properties-form.open_plan_kitchen')"
                />
            </div>
            <!--Smart home-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="smart_home"
                    :value="true"
                    v-model:checked="form.smart_home"
                />
                <InputLabel
                    for="smart_home"
                    :value="t('properties-form.smart_home')"
                />
            </div>
            <!--Furnished-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="furnished"
                    :value="true"
                    v-model:checked="form.furnished"
                />
                <InputLabel
                    for="furnished"
                    :value="t('properties-form.furnished')"
                />
            </div>
            <!--Building pool-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="building_pool"
                    :value="true"
                    v-model:checked="form.building_pool"
                />
                <InputLabel
                    for="building_pool"
                    :value="t('properties-form.building_pool')"
                />
            </div>
            <!--Building gym-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="building_gym"
                    :value="true"
                    v-model:checked="form.building_gym"
                />
                <InputLabel
                    for="building_gym"
                    :value="t('properties-form.building_gym')"
                />
            </div>
            <!--Wheelchair access-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="wheelchair_access"
                    :value="true"
                    v-model:checked="form.wheelchair_access"
                />
                <InputLabel
                    for="wheelchair_access"
                    :value="t('properties-form.wheelchair_access')"
                />
            </div>
            <!--Elevator-->
            <div class="flex items-center gap-3">
                <Checkbox
                    id="elevator"
                    :value="true"
                    v-model:checked="form.elevator"
                />
                <InputLabel
                    for="elevator"
                    :value="t('properties-form.elevator')"
                />
            </div>
        </div>
    </div>
    <!--Well water-->
    <div class="flex items-center gap-3">
        <Checkbox
            id="well_water"
            :value="true"
            v-model:checked="form.well_water"
        />
        <InputLabel for="well_water" :value="t('properties-form.well_water')" />
    </div>
    <!--Electricity-->
    <div class="flex items-center gap-3">
        <Checkbox
            id="electricity"
            :value="true"
            v-model:checked="form.electricity"
        />
        <InputLabel
            for="electricity"
            :value="t('properties-form.electricity')"
        />
    </div>
</template>

<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    form: Object,
    checked: [Array, Boolean],
});
</script>
