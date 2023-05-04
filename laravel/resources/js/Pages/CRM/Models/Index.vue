<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Card from 'primevue/card';
import Button from 'primevue/button';
import Toolbar from 'primevue/toolbar';
import {Link} from "@inertiajs/vue3";
import Toast from 'primevue/toast';
import moment from "moment";

const props = defineProps({
    models: Object,
    bodies: Object,
    fuels: Object,
});
</script>

<template>
    <AppLayout title="Модели">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Модели
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #title>
                            <Toolbar class="mb-4">
                                <template #start>
                                    <Link :href="route('crm.models.create')">
                                        <Button severity="info" label="Создать" icon="pi pi-plus" class="mr-2"/>
                                    </Link>
                                    <Toast />
                                </template>
                            </Toolbar>
                        </template>
                        <template #content>
                            <div class="card">
                                <DataTable :value="models" removableSort sortMode="multiple" tableStyle="min-width: 50rem">
                                    <Column field="id" header="ID" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.models.show', [slotProps.data.id])" v-text="slotProps.data.id" />
                                        </template>
                                    </Column>
                                    <Column field="name" header="Наименование" sortable style="width: 20%"></Column>
                                    <Column field="brand" header="Марка" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.brands.show', [slotProps.data.brand.id])" v-text="slotProps.data.brand.name" />
                                        </template>
                                    </Column>
                                    <Column field="country" header="Страна" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.countries.show', [slotProps.data.country.id])" v-text="slotProps.data.country.name" />
                                        </template>
                                    </Column>
                                    <Column field="release_date" header="Год" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            {{moment(slotProps.data.release_date).format('YYYY')}}
                                        </template>
                                    </Column>
                                    <Column field="body" header="Кузов" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            {{bodies[slotProps.data.body]}}
                                        </template>
                                    </Column>
                                    <Column field="fuel" header="Топливо" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            {{fuels[slotProps.data.fuel]}}
                                        </template>
                                    </Column>
                                </DataTable>
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
