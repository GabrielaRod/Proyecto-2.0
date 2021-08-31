<template>
    <table class="w-full min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th
                    scope="col"
                    width="50"
                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase bg-gray-50"
                >
                    ID
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase bg-gray-50"
                >
                    Mac Address
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase bg-gray-50"
                >
                    Location
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="d in data" :key="d.id">
                <td
                    class="px-6 py-4 text-sm text-center text-gray-900 whitespace-nowrap"
                >
                    {{ d.id }}
                </td>
                <td
                    class="px-6 py-4 text-sm text-center text-gray-900 whitespace-nowrap"
                >
                    {{ d.data.macAddress }}
                </td>
                <td
                    class="px-6 py-4 text-sm text-center text-gray-900 whitespace-nowrap"
                >
                    {{ d.location }}
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    data() {
        return {
            data: []
        };
    },
    async created() {
        console.log("prueba");
        const { data } = await axios.get("live/data");
        console.log(data);
        this.data = data.map(x => {
            const kk = JSON.parse(x.data.replaceAll("'", '"'));
            return {
                data: kk,
                id: x.id,
                location: x.location
            };
        });
    }
};
</script>
