<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Card from 'primevue/card';
import Button from 'primevue/button';
import Toolbar from 'primevue/toolbar';
import {Link} from "@inertiajs/vue3";
import Toast from 'primevue/toast';

const props = defineProps({
    supplies: Object,
});
</script>

<template>
    <AppLayout title="Поставки">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #title>
                            <Toolbar class="mb-4">
                                <template #start>
                                    <Link :href="route('crm.supplies.create')">
                                        <Button label="Создать" icon="pi pi-plus" class="mr-2"/>
                                    </Link>
                                    <Toast />
                                </template>
                            </Toolbar>
                        </template>
                        <template #content>
                            <div class="card">
                                <DataTable :value="supplies" removableSort sortMode="multiple" tableStyle="min-width: 50rem">
                                    <Column field="id" header="ID" sortable style="width: 5%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.supplies.show', [slotProps.data.id])" v-text="slotProps.data.id" />
                                        </template>
                                    </Column>
                                    <Column field="model_id" header="Комплектация" style="width: 20%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.equipments.show', [slotProps.data.equipment_id])" v-text="slotProps.data.equipment.name" />
                                        </template>
                                    </Column>
                                    <Column field="supplier_id" header="Поставщик" style="width: 20%">
                                        <template #body="slotProps">
                                            <a v-if="slotProps.data.supplier_id" class="text-blue-600" :href="route('crm.suppliers.show', [slotProps.data.supplier_id])" v-text="slotProps.data.supplier.name" />
                                        </template>
                                    </Column>
                                    <Column field="user_id" header="Сотрудник" style="width: 30%">
                                        <template #body="slotProps">
                                            {{slotProps.data.user.name}}
                                        </template>
                                    </Column>
                                    <Column field="user_id" header="Цена" style="width: 20%">
                                        <template #body="slotProps">
                                            {{slotProps.data.price ? new Intl.NumberFormat('ru-RU', { style: 'currency', currency: 'RUB' }).format(slotProps.data.price) : ''}}
                                        </template>
                                    </Column>
                                    <Column field="status" header="Статус" style="width: 5%">
                                        <template #body="slotProps">
                                            <i v-if="slotProps.data.supplied_at" style="color: green;" class="pi pi-check-circle" v-tooltip="'Автомобиль прибыл'"></i>
                                            <i v-else-if="slotProps.data.supplier_id" style="color: dodgerblue;" class="pi pi-clock" v-tooltip="'Автомобиль поставляется'"></i>
                                            <i v-else class="pi pi-exclamation-triangle" style="color: orange;" v-tooltip="'Поставка не согласована с поставщиком'" ></i>
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