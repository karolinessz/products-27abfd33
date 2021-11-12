<template>
<notificationGroup group="foo">
    <div class="fixed inset-0 z-50 flex px-4 py-6 pointer-events-none p-6 items-start justify-end">
        <div class="max-w-sm w-full">
            <notification v-slot="{notifications}">
                <div class="flex max-w-sm w-full mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-4" v-for="notification in notifications" :key="notification.id">
                    <div :class="`flex justify-center items-center w-16 bg-${notification.color}-500`">
                        <template v-if="notification.color == 'green'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </template>
                        <template v-if="notification.color == 'yellow'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </template>
                        <template v-if="notification.color == 'red'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </template>
                        <template v-if="notification.color == 'blue'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </template>
                    </div>

                    <div class="-mx-3 py-2 px-4">
                        <div class="mx-3">
                            <span :class="`text-${notification.color}-500 font-semibold`">{{notification.title}}</span>
                            <p class="text-gray-600 text-sm">{{notification.text}}</p>
                        </div>
                    </div>
                </div>
            </notification>
        </div>
    </div>
</notificationGroup>
</template>

<script>
export default {
    name: "Alert"
}
</script>
