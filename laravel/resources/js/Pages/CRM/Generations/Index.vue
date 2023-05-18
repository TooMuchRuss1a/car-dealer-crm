<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Card from 'primevue/card';
import Button from 'primevue/button';
import Toolbar from 'primevue/toolbar';
import {Link} from "@inertiajs/vue3";
import Toast from 'primevue/toast';
import moment from "moment/moment";

const props = defineProps({
    generations: Object,
});
</script>

<template>
    <AppLayout title="Поколения">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #title>
                            <Toolbar class="mb-4">
                                <template #start>
                                    <Link :href="route('crm.generations.create')">
                                        <Button label="Создать" icon="pi pi-plus" class="mr-2"/>
                                    </Link>
                                    <Toast />
                                </template>
                            </Toolbar>
                        </template>
                        <template #content>
                            <div class="card">
                                <DataTable :value="generations" removableSort sortMode="multiple" tableStyle="min-width: 50rem">
                                    <Column field="id" header="ID" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.generations.show', [slotProps.data.id])" v-text="slotProps.data.id" />
                                        </template>
                                    </Column>
                                    <Column field="name" header="Наименование" sortable style="width: 20%">
                                        <template #body="slotProps">
                                            {{slotProps.data.number}} поколение{{slotProps.data.restyling ? ', рестайлинг' : ''}} {{moment(slotProps.data.from).format('YYYY')}}-{{slotProps.data.to ? moment(slotProps.data.to).format('YYYY') : 'н.в.'}}
                                        </template>
                                    </Column>
                                    <Column field="model" header="Модель" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.models.show', [slotProps.data.model.id])" v-text="slotProps.data.model.name" />
                                        </template>
                                    </Column>
                                    <Column field="engine" header="Двигатель" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.engines.show', [slotProps.data.engine.id])" v-text="slotProps.data.engine.name" />
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
