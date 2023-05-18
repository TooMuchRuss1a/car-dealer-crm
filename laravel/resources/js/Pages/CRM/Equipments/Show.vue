<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import {ref} from 'vue';
import Toolbar from 'primevue/toolbar';
import {Link, router} from "@inertiajs/vue3";
import {useConfirm} from "primevue/useconfirm";
import {useToast} from "primevue/usetoast";
import ConfirmDialog from "primevue/confirmdialog";
import Toast from 'primevue/toast';

const props = defineProps({
    equipment: Object,
    bodies: Object,
    types: Object,
});

const submitted = ref(false);
const confirm = useConfirm();
const toast = useToast();

const confirmDelete = () => {
    confirm.require({
        message: 'Вы действительно хотите удалить запись?',
        header: 'Подтвердите удаление',
        icon: 'pi pi-info-circle',
        acceptClass: 'p-button-danger',
        accept: () => {
            destroy()
        },
    });
};

const destroy = () => {
    router.visit(route('crm.equipments.destroy', [props.equipment.id]), {
        method: 'delete',
        onSuccess: page => {
            toast.add({ severity: 'success', summary: 'Успешно', detail: 'Комплектация удалена', life: 3000 });
        },
        onError: errors => {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Произошла ошибка', life: 3000 });
        },
    })
};
</script>

<template>
    <AppLayout title="Комплектации">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #title>
                            <Toolbar class="mb-4">
                                <template #start>
                                    <div class="card flex flex-wrap gap-3  justify-content-center">
                                        <Link :href="route('crm.equipments.edit', [equipment.id])">
                                            <Button label="Редактировать" icon="pi pi-pencil" class="mr-2"/>
                                        </Link>
                                        <Button @click="confirmDelete()" label="Удалить" severity="danger" icon="pi pi-trash" class="mr-2"/>
                                        <ConfirmDialog></ConfirmDialog>
                                        <Toast />
                                    </div>
                                </template>
                            </Toolbar>
                        </template>
                        <template #content>
                            <div class="card flex flex-col">
                                <div class="relative overflow-x-auto">
                                    <table class="w-full text-sm text-left">
                                        <tbody>
                                            <tr class="border-b">
                                                <th scope="row" colspan="2" class="text-lg px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Основное
                                                </th>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Наименование
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.name}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Тип
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{types[equipment.type]}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Кузов
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{bodies[equipment.body]}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Количество дверей
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.doors_count}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Количество сидений
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.seats_count}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Длина
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.length}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Ширина
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.width}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Высота
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.height}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Максимальная скорость
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.max_speed}} км/ч
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Время разгона до 100км/ч
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.acceleration_time}} с
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Наименование шин
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.tires_name}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" colspan="2" class="text-lg px-6 py-4 pt-8 font-bold text-gray-900 whitespace-nowrap">
                                                    Топливо и расход
                                                </th>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Расход топлива при скорости 90 км/ч
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.fuel_consumption_90}} л/100км
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Расход топлива при скорости 120 км/ч
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.fuel_consumption_120}} л/100км
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Расход топлива при городском цикле
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{equipment.fuel_consumption_city}} л/100км
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
