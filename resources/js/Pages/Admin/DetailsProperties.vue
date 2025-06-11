<template>
    <Head>
        <title>{{ t("admin-dashboard.property-details") }}</title>
    </Head>
    <AdminLayout title="Property Details">
        <div class="px-6 py-4 bg-white rounded-lg shadow">
            <!-- Approval Status Banner -->
            <div
                v-if="props.property.status === 'pending'"
                class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-400"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <font-awesome-icon
                            icon="exclamation-triangle"
                            class="h-5 w-5 text-yellow-400"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            {{ t("admin-dashboard.property-details-text") }}
                            <span class="font-bold">{{
                                t("admin-dashboard.property-details-text2")
                            }}</span
                            >. {{ t("admin-dashboard.property-details-text3") }}
                        </p>
                    </div>
                </div>
            </div>
            <div
                v-if="props.property.status === 'active'"
                class="mb-6 p-4 bg-green-50 border-l-4 border-green-400"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <font-awesome-icon
                            icon="check"
                            class="h-5 w-5 text-green-400"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ t("admin-dashboard.property-details-text") }}
                            <span class="font-bold">{{
                                t("admin-dashboard.active")
                            }}</span
                            >.
                        </p>
                    </div>
                </div>
            </div>
            <div
                v-if="props.property.status === 'refused'"
                class="mb-6 p-4 bg-red-50 border-l-4 border-red-400"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <font-awesome-icon
                            icon="xmark"
                            class="h-5 w-5 text-red-400"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            {{ t("admin-dashboard.refused-text") }}
                            <span class="font-bold"> {{ t("admin-dashboard.refused") }}.</span>
                             {{ t("admin-dashboard.refused-owner") }}
                            <p class="text-lg text-red-700">{{ t("admin-dashboard.reason") }} {{ props.property.reason_for_refusal }}
                            </p>
                        </p>
                    </div>
                </div>
            </div>
            <div
                v-if="props.property.status === 'sold'"
                class="mb-6 p-4 bg-green-50 border-l-4 border-emerald-400"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <font-awesome-icon
                            icon="check"
                            class="h-5 w-5 text-emerald-400"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-emerald-700">
                            {{ t("admin-dashboard.property-details-text") }}
                            <span class="font-bold">{{
                                t("admin-dashboard.sold")
                            }}</span
                            >.
                        </p>
                    </div>
                </div>
            </div>

            <div
                v-if="props.property.status === 'rented'"
                class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-400"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <font-awesome-icon
                            icon="check"
                            class="h-5 w-5 text-blue-400"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                           {{t("admin-dashboard.property-details-text")}}
                            <span class="font-bold">{{t("admin-dashboard.rented")}}</span
                            >.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Property Header -->
            <div
                class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6"
            >
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">
                        {{ props.property.title }}
                    </h2>
                    <p class="text-gray-600">
                        <font-awesome-icon icon="location-dot" class="mr-2"/>
                        {{ props.property.address }}, {{ props.property.city }},
                        {{ props.property.district }} -
                        {{ props.property.postal_code }}
                    </p>
                </div>

                <div
                    class="flex space-x-3 mt-4 md:mt-0"
                    v-if="props.property.status === 'pending'"
                >
                    <form @submit.prevent="activeProperty" class="flex gap-5">
                        <button
                            type="submit"
                            @click="form.status = 'active'"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center"
                        >
                            <font-awesome-icon icon="check" class="mr-2" />
                            {{ t("admin-dashboard.accept") }}
                        </button>    
                        <button
                            type="button"
                            @click="openUpdateModal(property)"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md flex items-center"
                        >
                            <font-awesome-icon icon="times" class="mr-2" />
                            {{ t("admin-dashboard.refuse") }}
                        </button>
                    </form>
                </div>

                <div
                    class="flex space-x-3 mt-4 md:mt-0"
                    v-if="props.property.status === 'active'"
                >
                        <div v-if="props.property.transaction_id === 1">
                            <Link :href="route('admin.properties.registersale', { property: props.property.slug })">
                                <button
                                    type="button"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center"
                                >
                                    <font-awesome-icon icon="plus" class="mr-2" />
                                    {{t("admin-dashboard.edit")}}
                                </button>
                            </Link>
                        </div>
                        <div v-if="props.property.transaction_id === 2">
                            <Link :href="route('admin.properties.registerrent', { property: props.property.slug })">
                                <button
                                    type="button"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center"
                                >
                                    <font-awesome-icon icon="plus" class="mr-2" />
                                    {{t("admin-dashboard.initial-rent-process")}}
                                </button>
                            </Link>
                        </div>
                </div>
            </div>

            <!-- Property Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Main Property Info -->
                <div class="md:col-span-2">
                    <!-- Image Gallery -->
                    <div class="mb-6">
                        <div
                            class="w-full sm:rounded-lg md:rounded-xl overflow-hidden"
                        >
                            <PropertiesShow
                                :images="props.property.media"
                                :properties="props.property"
                            />
                        </div>
                        <div class="grid grid-cols-4 gap-2 mt-2"></div>
                    </div>

            <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <font-awesome-icon icon="sack-dollar" class="gap-3 mr-2 size-5 text-indigo-500"/>
                        {{ t("admin-dashboard.price") }}
                    </h3>
                <ul class="space-y-3">
                    <div v-if="props.property.transaction_id == 1">
                        <li class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.property-price")}}</span>
                            <span class="text-gray-800 font-semibold">{{ formatPrice(props.property.price) + '€' }}</span>
                        </li>
                        <li v-if="showContract(props.property.id)" class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.buyers-price")}}</span>
                            <span class="text-blue-600 font-bold">{{ formatPrice(showContract(props.property.id).final_price + '€') }}</span>
                        </li>
                        <li v-if="showContract(props.property.id)"  class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.commission")}}</span>
                            <span class="text-blue-600 font-bold">{{ showContract(props.property.id).commission + '%' }}</span>
                        </li>
                        <li v-if="showContract(props.property.id)"  class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.final-price")}}</span>
                            <span class="text-green-600 font-bold">{{ formatPrice(showContract(props.property.id).final_price_for_seller + '€') }}</span>
                        </li>
                        <li v-if="showContract(props.property.id)"  class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.our-total-revenue")}}</span>
                            <span class="text-green-600 font-bold">{{ formatPrice(showContract(props.property.id).total_revenue + '€') }}</span>
                        </li>
                    </div>


                    <div v-if="props.property.transaction_id == 2">
                        <li class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.property-rent-price")}}</span>
                            <span class="text-gray-800 font-semibold">{{ formatPrice(props.property.price) + '€' }} <span class="text-sm text-gray-400">{{t("properties.per-month")}}</span></span>
                        </li>
                        <li v-if="showContractRent(props.property.id)" class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.price-agreed")}}</span>
                            <span class="text-gray-800 font-bold">{{ showContractRent(props.property.id).price + '€' }}</span>
                        </li>
                        <li v-if="showContractRent(props.property.id)" class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.months-contract")}}</span>
                            <span class="text-gray-800 font-bold">{{ showContractRent(props.property.id).months_contract }}</span>
                        </li>
                        <li v-if="showContractRent(props.property.id)" class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.total-contract")}}</span>
                            <span class="text-blue-600 font-bold">{{ formatPrice(showContractRent(props.property.id).total_price_contract + '€') }}</span>
                        </li>
                        <li  v-if="showContractRent(props.property.id)" class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.commission")}}</span>
                            <span class="text-blue-600 font-bold">{{ showContractRent(props.property.id).commission + '%' }}</span>
                        </li>
                        <li  v-if="showContractRent(props.property.id)" class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{ t("admin-dashboard.revenue-landlord") }}</span>
                            <span class="text-green-600 font-bold">{{ formatPrice(showContractRent(props.property.id).total_landlord_revenue + '€')}}</span>
                        </li>
                        <li  v-if="showContractRent(props.property.id)" class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.our-total-revenue")}}</span>
                            <span class="text-green-600 font-bold">{{ formatPrice(showContractRent(props.property.id).total_revenue + '€') }}</span>
                        </li>
                        <li  v-if="showContractRent(props.property.id)" class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">{{t("admin-dashboard.our-total-revenue-per-month")}}</span>
                            <span class="text-green-600 font-bold">{{ formatPrice(showContractRent(props.property.id).total_revenue_per_month + '€') }} <span class="text-sm text-gray-400">{{t("properties.per-month")}}</span> </span>
                        </li>
                        
                    </div>
                </ul>
            </div>

                    <hr
                        class="my-8"
                        v-if="
                            props.property.category_id === 1 ||
                            props.property.category_id === 2
                        "
                    />

                    <EssentialsHighlights :properties="props.property" />
                    <hr
                        class="my-8"
                        v-if="
                            props.property.category_id === 1 ||
                            props.property.category_id === 2
                        "
                    />
                    <InteriorHighlights
                        v-if="
                            props.property.category_id === 1 ||
                            props.property.category_id === 2
                        "
                        :properties="props.property"
                    />
                    <hr
                        class="my-8"
                        v-if="
                            props.property.category_id === 1 ||
                            props.property.category_id === 2
                        "
                    />
                    <OutdoorHighlights
                        v-if="
                            props.property.category_id === 1 ||
                            props.property.category_id === 2
                        "
                        :properties="props.property"
                    />
                    <hr class="my-8" />

                    <!-- Description -->
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-4 mt-4 ml-3">
                            {{ t("admin-dashboard.description") }}
                        </h3>
                        <p class="mb-4 mt-4 ml-3 text-gray-600 whitespace-pre-line">
                            {{ props.property.description }}
                        </p>
                    </div>

                    <hr class="my-8" />

                    <EnergyBalance  :properties="props.property" v-if="
                            props.property.category_id === 1 ||
                            props.property.category_id === 2
                        "/>
                </div>

                <!-- User Info and Sidebar -->
                <div class="space-y-6">
                    <!-- Owner/Agent Info -->
                    <div v-if="props.property.status === 'active'"
                        class="bg-white border border-gray-200 rounded-lg shadow p-4"
                    >
                        <h3 class="text-lg font-medium text-gray-800 mb-4"> 
                            {{ t("admin-dashboard.submitted-by") }}
                        </h3>
                        <div class="flex items-center space-x-4 mb-4">
                            <div>
                                <p class="font-medium text-gray-900">
                                    {{ showOwner(props.property).name }}                                                     
                                </p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="envelope"
                                    class="mr-2 text-gray-400"
                                />
                                {{ showOwner(props.property).email }}                
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="map"
                                    class="mr-2 text-gray-400"
                                />
                                {{
                                    showOwner(props.property).nationality ||
                                    t("admin-dashboard.not-provided")
                                }}
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="id-card"
                                    class="mr-2 text-gray-400"
                                />
                                {{
                                    "ID: " +
                                        showOwner(props.property).identification_number ||
                                    t("admin-dashboard.not-provided")
                                }}
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="id-card"
                                    class="mr-2 text-gray-400"
                                />
                                {{
                                    "NIF: " + showOwner(props.property).tax_number ||
                                    t("admin-dashboard.not-provided")
                                }}
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="phone"
                                    class="mr-2 text-gray-400"
                                />
                                {{
                                    showOwner(props.property).phone_number ||
                                    t("admin-dashboard.not-provided")
                                }}
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="clock"
                                    class="mr-2 text-gray-400"
                                />
                                {{ t("admin-dashboard.submitted-in") }}
                                {{ formatDate(props.property.created_at) }}
                            </div>
                            <div
                                v-if="props.property.status === 'active'"
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="clock"
                                    class="mr-2 text-gray-400"
                                />
                                {{ t("admin-dashboard.active-in") }}
                                {{ formatDate(props.property.updated_at) }}
                            </div>
                            <div
                                v-if="props.property.status === 'refused'"
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="clock"
                                    class="mr-2 text-gray-400"
                                />
                                {{ t("admin-dashboard.refused-in") }}:
                                {{ formatDate(props.property.updated_at) }}
                            </div>
                        </div>
                    </div>

                    <!--Sold-->
                    <div v-if="props.property.status === 'sold'">
                        <div 
                            class="bg-white border border-gray-200 rounded-lg shadow p-4"
                        >
                            <h3 class="text-lg font-medium text-gray-800 mb-4">
                                {{ t("admin-dashboard.submitted-by") }}
                            </h3>
                            <div class="flex items-center space-x-4 mb-4">
                                <div>
                                    <p class="font-medium text-gray-900">
                                        {{ showContract(props.property.id).owner.name }}
                                    </p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="envelope"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{ showContract(props.property.id).owner.email }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="map"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        showContract(props.property.id).owner.nationality ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="id-card"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        "ID: " +
                                            showContract(props.property.id).owner.identification_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="id-card"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        "NIF: " + showContract(props.property.id).owner.tax_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="phone"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        showContract(props.property.id).owner.phone_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="clock"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{ t("admin-dashboard.submitted-in") }}
                                    {{ formatDate(props.property.created_at) }}
                                </div>
                                <div
                                    v-if="props.property.status === 'active'"
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="clock"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{ t("admin-dashboard.active-in") }}
                                    {{ formatDate(props.property.updated_at) }}
                                </div>
                                <div
                                    v-if="props.property.status === 'refused'"
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="clock"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{ t("admin-dashboard.refused-in") }}:
                                    {{ formatDate(props.property.updated_at) }}
                                </div>
                            </div>
                        </div>
                        <div 
                            class="bg-white border border-gray-200 rounded-lg shadow p-4"
                        >
                            <h3 class="text-lg font-medium text-gray-800 mb-4">
                                {{ t("admin-dashboard.bought-by") }}
                            </h3>
                            <div class="flex items-center space-x-4 mb-4">
                                <div>
                                    <p class="font-medium text-gray-900">
                                         {{ showContract(props.property.id).buyer.name }}
                                    </p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="envelope"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{ showContract(props.property.id).buyer.email }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="map"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        showContract(props.property.id).buyer.nationality ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="id-card"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        "ID: " +
                                            showContract(props.property.id).buyer.identification_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="id-card"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        "NIF: " + showContract(props.property.id).buyer.tax_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="phone"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        showContract(props.property.id).buyer.phone_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="clock"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{ t("admin-dashboard.bought-in") }}
                                    {{ formatDate(showContract(props.property.id).offer_date) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Rented-->
                    <div v-if="props.property.status === 'rented'">
                        <div 
                            class="bg-white border border-gray-200 rounded-lg shadow p-4"
                        >
                            <h3 class="text-lg font-medium text-gray-800 mb-4">
                                {{ t("admin-dashboard.submitted-by") }}
                            </h3>
                            <div class="flex items-center space-x-4 mb-4">
                                <div>
                                    <p class="font-medium text-gray-900">
                                        {{ showContractRent(props.property.id).landlord.name }}
                                    </p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="envelope"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{ showContractRent(props.property.id).landlord.email }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="map"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        showContractRent(props.property.id).landlord.nationality ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="id-card"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        "ID: " +
                                            showContractRent(props.property.id).landlord.identification_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="id-card"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        "NIF: " + showContractRent(props.property.id).landlord.tax_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="phone"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        showContractRent(props.property.id).landlord.phone_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="clock"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{ t("admin-dashboard.submitted-in") }}
                                    {{ formatDate(props.property.created_at) }}
                                </div>
                                <div
                                    v-if="props.property.status === 'active'"
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="clock"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{ t("admin-dashboard.active-in") }}
                                    {{ formatDate(props.property.updated_at) }}
                                </div>
                                <div
                                    v-if="props.property.status === 'refused'"
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="clock"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{ t("admin-dashboard.refused-in") }}:
                                    {{ formatDate(props.property.updated_at) }}
                                </div>
                            </div>
                        </div>
                        <div 
                            class="bg-white border border-gray-200 rounded-lg shadow p-4"
                        >
                            <h3 class="text-lg font-medium text-gray-800 mb-4">
                                {{t("admin-dashboard.rented-by")}}                            </h3>
                            <div class="flex items-center space-x-4 mb-4">
                                <div>
                                    <p class="font-medium text-gray-900">
                                         {{ showContractRent(props.property.id).tenant.name }}
                                    </p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="envelope"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{ showContractRent(props.property.id).tenant.email }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="map"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        showContractRent(props.property.id).tenant.nationality ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="id-card"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        "ID: " +
                                            showContractRent(props.property.id).tenant.identification_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="id-card"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        "NIF: " + showContractRent(props.property.id).tenant.tax_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="phone"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{
                                        showContractRent(props.property.id).tenant.phone_number ||
                                        t("admin-dashboard.not-provided")
                                    }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="clock"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{t("admin-dashboard.start-contract")}}
                                    {{ formatDate(showContractRent(props.property.id).start_contract) }}
                                </div>
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <font-awesome-icon
                                        icon="clock"
                                        class="mr-2 text-gray-400"
                                    />
                                    {{t("admin-dashboard.end-contract")}}
                                    {{ formatDate(showContractRent(props.property.id).end_contract) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white border border-gray-200 rounded-lg shadow p-4"
                    >
                        <h3 class="text-lg font-medium text-gray-800 mb-4">
                            {{ t("admin-dashboard.documents") }}:
                        </h3>
                        <div class="flex items-center space-x-4 mb-4">
                            <div>
                                <a
                                    :href="
                                        route('admin.properties.documents', {
                                            slug: property.slug,
                                        })
                                    "
                                >
                                    <p>{{ t("admin-dashboard.download") }}</p>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <InputModal
            :isOpen="isModalOpen"
            :title="t('admin-dashboard.refuse-property')"
            @close="closeModal"
        >
            <form @submit.prevent="refuseProperty" class="space-y-4">
                <div>
                    <InputLabel :value="t('admin-dashboard.reason')" />
                    <TextInput  v-model="form.reason_for_refusal" required />
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button
                        type="button"
                        @click="closeModal"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        {{ t("update-form.cancel") }}
                    </button>
                    <button
                        type="submit"
                        @click="form.status = 'refused'"
                        class="px-4 py-2 bg-red-600 rounded-md text-sm font-medium text-white hover:bg-red-700"
                    >
                        {{ t("admin-dashboard.refuse") }}
                    </button>
                </div>
            </form>
        </InputModal>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PropertiesShow from "@/Components/PropertiesShow.vue";
import EssentialsHighlights from "../Properties/Partials/EssentialsHighlights.vue";
import InteriorHighlights from "../Properties/Partials/InteriorHighlights.vue";
import OutdoorHighlights from "../Properties/Partials/OutdoorHighlights.vue";
import InputModal from "@/Components/InputModal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import EnergyBalance from "../Properties/Partials/EnergyBalance.vue";
import { format } from "date-fns";
import { pt } from "date-fns/locale";
import { enUS } from "date-fns/locale";
import { useI18n } from "vue-i18n";
import { useForm, Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

const { locale, t } = useI18n();

const props = defineProps({
    property: Object,
    categories: Array,
    downloads: Array,
    sales_contract: Object,
    rents_contract: Object
});

const showContract = (property_id) => {
    return props.sales_contract.find((c) => c.property_id === property_id);
}

const showContractRent = (property_id) => {
    return props.rents_contract.find((c) => c.property_id === property_id);
}

const showOwner = () => {
    return props.property.user
}

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

const isModalOpen = ref(false);

const closeModal = () => {
    isModalOpen.value = false;
};

const openUpdateModal = (property) => {
    form.value = { ...property };
    isModalOpen.value = true;
};

const formatDate = (dateStr) => {
    if (locale.value === "en")
        return format(new Date(dateStr), "MM/dd/yyyy", { locale: enUS });
    if (locale.value === "pt")
        return format(new Date(dateStr), "dd/MM/yyyy", { locale: pt });
};

const form = useForm({
    status: props.property.status,
    reason_for_refusal: null,
});

const activeProperty = () => {
    form.status = 'active';

    form.patch(
        route("admin.properties.update", { property: props.property.slug }),
        {
            preserveScroll: true,
        },
    );
};

const refuseProperty = () => {
    form.status = 'refused';

    form.patch(
        route("admin.properties.update", { property: props.property.slug }),
        {
            preserveScroll: true,
            onSuccess: () => {
                closeModal();
            },
        }
    );
};
</script>
