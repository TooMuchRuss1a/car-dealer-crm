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
    orders: Object,
});
</script>

<template>
    <AppLayout title="Заказы">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #title>
                            <Toolbar class="mb-4">
                                <template #start>
                                    <Link :href="route('crm.orders.create')">
                                        <Button label="Создать" icon="pi pi-plus" class="mr-2"/>
                                    </Link>
                                    <Toast />
                                </template>
                            </Toolbar>
                        </template>
                        <template #content>
                            <div class="card">
                                <DataTable :value="orders" removableSort sortMode="multiple" tableStyle="min-width: 50rem">
                                    <Column field="id" header="ID" sortable style="width: 5%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.orders.show', [slotProps.data.id])" v-text="slotProps.data.id" />
                                        </template>
                                    </Column>
                                    <Column field="car" header="Авто" sortable style="width: 40%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.cars.show', [slotProps.data.car.id])" v-text="slotProps.data.car.supply.equipment.name + ' | ' + slotProps.data.car.supply.equipment.generation.model.name + ' | '  + slotProps.data.car.supply.equipment.generation.model.brand.name" />
                                        </template>
                                    </Column>
                                    <Column field="user.name" header="Сотрудник" sortable style="width: 35%"></Column>
                                    <Column field="status" header="Статус" sortable style="width: 5%">
                                        <template #body="slotProps">
                                            <div class="space-x-1">
                                                <i v-if="slotProps.data.contract_signed_at === null" style="color: dodgerblue;" class="pi pi-file" v-tooltip="'Необходимо подписать договор'"></i>
                                                <i v-if="slotProps.data.contract_signed_at !== null && slotProps.data.car_transferred_at === null" style="color: dodgerblue;" class="pi pi-car" v-tooltip="'Необходимо передать авто клиенту'"></i>
                                                <i v-if="slotProps.data.contract_signed_at !== null && slotProps.data.payment_received_at === null" style="color: dodgerblue;" class="pi pi-wallet" v-tooltip="'Необходимо принять оплату полностью'"></i>
                                                <i v-if="slotProps.data.car_transferred_at !== null && slotProps.data.payment_received_at !== null" style="color: dodgerblue;" class="pi pi-thumbs-up" v-tooltip="'Сделка завершена'"></i>
                                            </div>
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