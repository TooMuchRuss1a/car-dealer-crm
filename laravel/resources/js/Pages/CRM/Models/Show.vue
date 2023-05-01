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
import moment from "moment";

const props = defineProps({
    model: Object,
    bodies: Array,
    fuels: Array,
    types: Array,
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
    router.visit(route('crm.models.destroy', [props.model.id]), {
        method: 'delete',
        onSuccess: page => {
            toast.add({ severity: 'success', summary: 'Успешно', detail: 'Модель удалена', life: 3000 });
        },
        onError: errors => {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Произошла ошибка', life: 3000 });
        },
    })
};
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
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #title>
                            <Toolbar class="mb-4">
                                <template #start>
                                    <div class="card flex flex-wrap gap-3  justify-content-center">
                                        <Link :href="route('crm.models.edit', [model.id])">
                                            <Button label="Редактировать" class="mr-2"/>
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
                                                    {{model.name}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Марка
                                                </th>
                                                <td class="px-6 py-4">
                                                    <a class="text-indigo-600" :href="route('crm.brands.show', [model.brand.id])" v-text="model.brand.name" />
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Страна
                                                </th>
                                                <td class="px-6 py-4">
                                                    <a class="text-indigo-600" :href="route('crm.countries.show', [model.country.id])" v-text="model.country.name" />
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Год выпуска
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{moment(model.release_date).format('YYYY')}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Тип
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{types[model.type]}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Кузов
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{bodies[model.body]}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Количество дверей
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.doors_count}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Количество сидений
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.seats_count}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Длина
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.length}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Ширина
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.width}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Высота
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.height}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" colspan="2" class="text-lg px-6 py-4 pt-8 font-bold text-gray-900 whitespace-nowrap">
                                                    Двигатель
                                                </th>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Модель двигателя
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.engine_model}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Номер двигателя
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.engine_number}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Количество цилиндров
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.cylinders_count}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Рабочий объем двигателя
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.engine_capacity}} см3
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Мощность двигателя
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.engine_power}} л.с.
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Максимальный крутящий момент
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.max_torque}} Нм
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Максимальная скорость
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.max_speed}} км/ч
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Время разгона до 100км/ч
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.acceleration_time}} с
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" colspan="2" class="text-lg px-6 py-4 pt-8 font-bold text-gray-900 whitespace-nowrap">
                                                    Топливо и расход
                                                </th>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Используемый вид топлива
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{fuels[model.fuel]}}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Расход топлива при скорости 90 км/ч
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.fuel_consumption_90}} л/100км
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Расход топлива при скорости 120 км/ч
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.fuel_consumption_120}} л/100км
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                    Расход топлива при городском цикле
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{model.fuel_consumption_city}} л/100км
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
