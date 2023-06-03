<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Card from 'primevue/card';
import moment from "moment";
import Toolbar from 'primevue/toolbar';
import SearchField from "../../../Components/SearchField.vue";

const props = defineProps({
    cars: Object,
    statuses: Object,
});
</script>

<template>
    <AppLayout title="Авто">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #title>
                            <Toolbar class="mb-4">
                                <template #start>
                                    <div class="space-x-2">
                                        <SearchField/>
                                    </div>
                                </template>
                            </Toolbar>
                        </template>
                        <template #content>
                            <div class="card">
                                <DataTable :value="cars" removableSort sortMode="multiple" tableStyle="min-width: 50rem">
                                    <template #empty>
                                        <div class="text-base text-center">По вашему запросу ничего не нашлось</div>
                                    </template>
                                    <Column field="id" header="ID" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.cars.show', [slotProps.data.id])" v-text="slotProps.data.id" />
                                        </template>
                                    </Column>
                                    <Column field="equipment" header="Комплектация" sortable style="width: 40%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.equipments.show', [slotProps.data.supply.equipment.id])" v-text="slotProps.data.supply.equipment.name + ' | ' + slotProps.data.supply.equipment.generation.model.name + ' | ' + slotProps.data.supply.equipment.generation.model.brand.name" />
                                        </template>
                                    </Column>
                                    <Column field="release_date" header="Год выпуска" sortable style="width: 20%">
                                        <template #body="slotProps">
                                            {{slotProps.data.release_date ? moment(slotProps.data.release_date).format("YYYY") : ''}}
                                        </template>
                                    </Column>
                                    <Column field="status" header="Статус" sortable style="width: 5%">
                                        <template #body="slotProps">
                                            <i v-if="slotProps.data.status === 'WAITING'" style="color: dodgerblue;" class="pi pi-clock" v-tooltip="'Ожидание завершения поставки'"></i>
                                            <i v-else-if="slotProps.data.status === 'PRESENT'" style="color: dodgerblue;" class="pi pi-eye-slash" v-tooltip="'В наличии: не отображается в каталоге'"></i>
                                            <i v-else-if="slotProps.data.status === 'SELLING'" style="color: dodgerblue;" class="pi pi-eye" v-tooltip="'В продаже: отображается в каталоге'"></i>
                                            <i v-else-if="slotProps.data.status === 'SOLD'" style="color: dodgerblue;" class="pi pi-thumbs-up" v-tooltip="'Продано'"></i>
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
