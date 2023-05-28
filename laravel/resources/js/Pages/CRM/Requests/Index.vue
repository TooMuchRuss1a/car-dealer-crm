<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Card from 'primevue/card';

const props = defineProps({
    carRequests: Object,
});
</script>

<template>
    <AppLayout title="Заявки">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #content>
                            <div class="card">
                                <DataTable :value="carRequests" removableSort sortMode="multiple" tableStyle="min-width: 50rem">
                                    <Column field="id" header="ID" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.requests.show', [slotProps.data.id])" v-text="slotProps.data.id" />
                                        </template>
                                    </Column>
                                    <Column field="name" header="Имя" sortable style="width: 20%"/>
                                    <Column field="phone" header="Телефон" sortable style="width: 20%"/>
                                    <Column field="car" header="Авто" sortable style="width: 50%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.cars.show', [slotProps.data.car.id])" v-text="slotProps.data.car.supply.equipment.name + ' | ' + slotProps.data.car.supply.equipment.generation.model.name + ' | '  + slotProps.data.car.supply.equipment.generation.model.brand.name" />
                                        </template>
                                    </Column>
                                    <Column field="status" header="Статус" sortable style="width: 5%">
                                        <template #body="slotProps">
                                            <i v-if="slotProps.data.status === 'OPEN'" style="color: dodgerblue;" class="pi pi-clock" v-tooltip="'Открыта: необходимо взять в работу'"></i>
                                            <i v-else-if="slotProps.data.status === 'IN_PROGRESS'" style="color: dodgerblue;" class="pi pi-phone" v-tooltip="'В работе'"></i>
                                            <i v-else-if="slotProps.data.status === 'CLOSED'" style="color: dodgerblue;" class="pi pi-thumbs-up" v-tooltip="'Закрыта'"></i>
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
