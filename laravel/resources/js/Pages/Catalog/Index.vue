<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Card from 'primevue/card';
import DataView from 'primevue/dataview';
import 'primeflex/primeflex.css';
import moment from "moment/moment";
import Toolbar from 'primevue/toolbar';
import SearchField from "../../Components/SearchField.vue";

const props = defineProps({
    cars: Object,
});
</script>

<template>
    <AppLayout title="Каталог">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #title>
                            <Toolbar class="mb-4">
                                <template #start>
                                    <SearchField/>
                                </template>
                            </Toolbar>
                        </template>
                        <template #content>
                            <div class="card">
                                <div v-if="Object.keys(cars).length === 0" class="md:text-xl text-base text-center">По вашему запросу ничего не нашлось</div>
                                <DataView :value="cars">
                                    <template #list="slotProps">
                                        <a :href="route('catalog.show', [slotProps.data.id])" class="col-12">
                                            <div class="flex flex-column xl:flex-row xl:align-items-start p-4 gap-4 hover:bg-black-alpha-10 transition ease-in-out duration-150 border-b">
                                                <img class="w-11 sm:w-16rem xl:w-16rem shadow-2 block xl:block mx-auto border-round" :src="'/storage/' + slotProps.data.photos[0].photo" :alt="slotProps.data.photos[0].photo" style="object-fit: cover;" />
                                                <div class="flex flex-column sm:flex-row justify-content-between align-items-center xl:align-items-start flex-1 gap-4">
                                                    <div class="flex flex-column align-items-center sm:align-items-start md:gap-3 gap-0">
                                                        <div class="md:text-2xl text-xl font-bold text-900">
                                                            <div>{{slotProps.data.supply.equipment.generation.model.brand.name}} {{slotProps.data.supply.equipment.generation.model.name}} {{slotProps.data.release_date ? moment(slotProps.data.release_date).format("YYYY") : ''}}</div>
                                                            <div class="font-semibold text-sm text-gray-600">{{slotProps.data.supply.equipment.name }}</div>
                                                            <div class="flex md:hidden text-sm font-semibold">{{slotProps.data.supply.equipment.generation.engine.max_power}} л.с. {{slotProps.data.supply.equipment.max_speed}} км/ч {{slotProps.data.mileage}} км</div>
                                                        </div>
                                                        <div class="flex align-items-center gap-3">
                                                            <span class="flex align-items-center gap-2">
                                                                <span class="md:flex flex-col gap-2 hidden">
                                                                    <span class="font-semibold">Мощность: {{slotProps.data.supply.equipment.generation.engine.max_power}} л.с.</span>
                                                                    <span class="font-semibold">Макс. скорость: {{slotProps.data.supply.equipment.max_speed}} км/ч</span>
                                                                    <span class="font-semibold">Пробег: {{slotProps.data.mileage}} км</span>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="flex sm:flex-column align-items-center sm:align-items-end gap-3 sm:gap-2">
                                                        <span class="text-2xl font-semibold">{{slotProps.data.price ? new Intl.NumberFormat('ru-RU', { style: 'currency', currency: 'RUB' }).format(slotProps.data.price) : ''}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </template>
                                </DataView>
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
