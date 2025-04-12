<script setup>
import { ref, onMounted } from "vue";
import * as leaflet from "leaflet";
import "leaflet/dist/leaflet.css";

const props = defineProps({
    center: {
        type: Array,
        default: () => [33.91249, 36.01431],
    },
    zoom: {
        type: Number,
        default: 13,
    },
    markers: {
        type: Array,
        default: () => [
            {
                position: { lat: 33.91249, lng: 36.01431 },
                title: "WMK-TECH Company",
            },
        ],
    },
});

const mapContainer = ref(null);
const map = ref(null);

onMounted(() => {
    // Initialize map
    map.value = leaflet
        .map(mapContainer.value)
        .setView(props.center, props.zoom);

    // Add tile layer
    leaflet
        .tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        })
        .addTo(map.value);

    // Add markers
    props.markers.forEach((marker) => {
        leaflet
            .marker(marker.position, {
                title: marker.title,
                icon: leaflet.icon({
                    iconUrl:
                        marker.icon ||
                        "https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png",
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                }),
            })
            .addTo(map.value)
            .bindPopup(marker.popup || marker.title);
    });
});
</script>

<template>
    <div ref="mapContainer" class="w-full h-100 rounded-lg shadow-lg"></div>
</template>
