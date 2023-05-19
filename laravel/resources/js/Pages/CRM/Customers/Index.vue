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
    customers: Object,
});
</script>

<template>
    <AppLayout title="Клиенты">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #title>
                            <Toolbar class="mb-4">
                                <template #start>
                                    <Link :href="route('crm.customers.create')">
                                        <Button label="Создать" icon="pi pi-plus" class="mr-2"/>
                                    </Link>
                                    <Toast />
                                </template>
                            </Toolbar>
                        </template>
                        <template #content>
                            <div class="card">
                                <DataTable :value="customers" removableSort sortMode="multiple" tableStyle="min-width: 50rem">
                                    <Column field="id" header="ID" sortable style="width: 10%">
                                        <template #body="slotProps">
                                            <a class="text-blue-600" :href="route('crm.customers.show', [slotProps.data.id])" v-text="slotProps.data.id" />
                                        </template>
                                    </Column>
                                    <Column field="name" header="ФИО" sortable style="width: 40%"></Column>
                                    <Column field="phone" header="Телефон" sortable style="width: 25%"></Column>
                                    <Column field="email" header="Почта" sortable style="width: 25%"></Column>
                                </DataTable>
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
