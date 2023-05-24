<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import {onMounted, ref} from 'vue';
import {useForm} from "@inertiajs/vue3";
import {useToast} from "primevue/usetoast";
import Toast from 'primevue/toast';
import Galleria from 'primevue/galleria';
import moment from "moment/moment";
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import InputMask from 'primevue/inputmask';
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import ProgressBar from 'primevue/progressbar';

const props = defineProps({
    car: Object,
    fuels: Object,
    bodies: Object
});

let images = ref([]);

const formDialog = ref(false);
const toast = useToast();

const form = useForm({
    name: null,
    phone: null,
});

onMounted(() => {
    images.value = [];
    Object.entries(props.car.photos).forEach(entry => {
        const [key, value] = entry;
        images.value.push({id: value.id, itemImageSrc: '/storage/' + value.photo, thumbnailImageSrc: '/storage/' + value.photo})
    })
});

const openForm = () => {
    formDialog.value = true;
};

const hideDialog = () => {
    formDialog.value = false;
};

const store = () => {
    // TODO request store
    // form.post(route('crm.request.store'), {
    //     onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Успешно', detail: 'Ожидайте звонка', life: 3000 });
            form.reset();
    //     },
    //     onError: () => {
    //         toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Произошла ошибка', life: 3000 });
    //     },
    // });
    hideDialog()
};
</script>

<template>
    <AppLayout title="Каталог">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #content>
                            <div class="card flex flex-col">
                                <div class="text-2xl font-bold">{{car.supply.equipment.generation.model.brand.name}} {{car.supply.equipment.generation.model.name}} {{car.release_date ? moment(car.release_date).format("YYYY") : ''}}</div>
                                <div class="relative overflow-x-auto md:flex">
                                    <Galleria :value="images" :numVisible="3" :circular="true" :showItemNavigators="true" container-class="w-full">
                                        <template #item="slotProps">
                                            <img :src="slotProps.item.itemImageSrc" :alt="slotProps.item.alt" style="width: 100%; height: 500px; object-fit: cover;"    />
                                        </template>
                                        <template #thumbnail="slotProps">
                                            <img :src="slotProps.item.thumbnailImageSrc" :alt="slotProps.item.alt" style="display: block; width: auto; height: 60px;" />
                                        </template>
                                    </Galleria>
                                    <div class="w-full">
                                        <div class="m-5 md:mt-0 space-y-2 items-center">
                                            <div class="text-2xl font-semibold">{{car.price ? new Intl.NumberFormat('ru-RU', { style: 'currency', currency: 'RUB' }).format(car.price) : ''}}</div>
                                            <Button label="Хочу купить" icon="pi pi-shopping-cart" class="mr-2 h-10" @click="openForm"/>
                                        </div>
                                        <Dialog v-model:visible="formDialog" :style="{width: '450px'}" header="Отправить заявку" :modal="true" class="p-fluid">
                                            <div class="space-y-2">
                                                <div class="field">
                                                    <label for="name">Ваше имя</label>
                                                    <InputText id="name" v-model.trim="form.name" v-bind:disabled="form.processing" required="true" autofocus :class="{'p-invalid': form.hasErrors && form.errors.name}" />
                                                    <small v-if="form.hasErrors" class="p-error">{{form.errors.name}}</small>
                                                </div>
                                                <div class="field">
                                                    <label for="phone">Телефон</label>
                                                    <InputMask mask="8 (999) 999-99-99" v-model.trim="form.phone" v-bind:disabled="form.processing" autofocus :class="{'p-invalid': form.hasErrors && form.errors.phone}"/>
                                                    <small v-if="form.hasErrors" class="p-error">{{form.errors.phone}}</small>
                                                </div>
                                            </div>
                                            <template #footer>
                                                <Button  label="Отмена" icon="pi pi-times" text @click="hideDialog"/>
                                                <Button v-bind:disabled="form.processing" label="Сохранить" icon="pi pi-check" text @click="store" />
                                                <ProgressBar class="mt-2" v-if="form.processing" mode="indeterminate" style="height: 3px"></ProgressBar>
                                            </template>
                                        </Dialog>
                                        <Toast />
                                        <table class="w-full text-sm text-left">
                                            <tbody>
                                                <tr class="border-b">
                                                    <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                        Поколение
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{car.supply.equipment.generation.number}} поколение{{car.supply.equipment.generation.restyling ? ', рестайлинг' : ''}} {{moment(car.supply.equipment.generation.from).format('YYYY')}}-{{car.supply.equipment.generation.to ? moment(car.supply.equipment.generation.to).format('YYYY') : 'н.в.'}}
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                        Комплектация
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{car.supply.equipment.name}}
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                        Кузов
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{bodies[car.supply.equipment.body]}}
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                        Цвет
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{car.color}}
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                        Пробег
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{car.mileage}} км
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                        Макс. скорость
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{car.supply.equipment.max_speed}} км/ч
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                        Разгон до 100км/ч
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{car.supply.equipment.acceleration_time}} с
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                                        Шины
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{car.supply.equipment.tires_name}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <Accordion class="m-1">
                                            <AccordionTab header="Двигатель и расход">
                                                <table class="w-full text-sm text-left">
                                                    <tbody>
                                                        <tr class="border-b">
                                                            <th scope="row" class="px-6 py-4 font-bold text-gray-900">
                                                                Наименование
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{car.supply.equipment.generation.engine.name}}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="row" class="px-6 py-4 font-bold text-gray-900">
                                                                Используемый вид топлива
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{fuels[car.supply.equipment.generation.engine.fuel]}}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="row" class="px-6 py-4 font-bold text-gray-900">
                                                                Количество цилиндров
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{car.supply.equipment.generation.engine.cylinders_count}}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="row" class="px-6 py-4 font-bold text-gray-900">
                                                                Рабочий объем двигателя
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{car.supply.equipment.generation.engine.capacity}} см3
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="row" class="px-6 py-4 font-bold text-gray-900">
                                                                Максимальная мощность двигателя
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{car.supply.equipment.generation.engine.max_power}} л.с.
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="row" class="px-6 py-4 font-bold text-gray-900я">
                                                                Максимальный крутящий момент
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{car.supply.equipment.generation.engine.max_torque}} Нм
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="row" class="px-6 py-4 font-bold text-gray-900">
                                                                Расход топлива при скорости 90 км/ч
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{car.supply.equipment.fuel_consumption_90}} л/100км
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="row" class="px-6 py-4 font-bold text-gray-900">
                                                                Расход топлива при скорости 120 км/ч
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{car.supply.equipment.fuel_consumption_120}} л/100км
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="row" class="px-6 py-4 font-bold text-gray-900">
                                                                Расход топлива при городском цикле
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{car.supply.equipment.fuel_consumption_city}} л/100км
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </AccordionTab>
                                        </Accordion>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
