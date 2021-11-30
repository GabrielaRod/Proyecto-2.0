<template>
  <div>
    <vue-good-table
      :columns="columns"
      :rows="rows"
      :search-options="{
        enabled: true,
      }"
      :pagination-options="{
        enabled: true,
        mode: 'records',
      }"
      styleClass="vgt-table condensed"
    />
  </div>
</template>

<script>
export default {
  name: "tag-report-component",
  data() {
    return {
      columns: [
        {
          label: "ID",
          field: "id",
        },
        {
          label: "VIN",
          field: "VIN",
          type: "string",
        },
        {
          label: "Placa",
          field: "LicensePlate",
          type: "string",
        },
           {
          label: "Marca",
          field: "Make",
          type: "string",
        },
        {
          label: "Modelo",
          field: "Model",
          type: "string",
        },
         {
          label: "Color",
          field: "Color",
          type: "string",
        },
           {
          label: "Nombre",
          field: "FirstName",
          type: "string",
        },
        {
          label: "Apellido",
          field: "LastName",
          type: "string",
        },
        {
          label: "Estatus",
          field: "Status",
          type: "string",
        },
        {
          label: "Created On",
          field: "created_at",
          type: "date",
          dateInputFormat: "yyyy-MM-dd HH:mm:ss",
          dateOutputFormat: "MMM do yy",
        },

      ],
      rows: [],
    };
  },
  methods: {
    async fetchData() {
      try {
        const { data } = await axios.get("alertReport");
        console.log(data);
        data.forEach((element) => {
          this.rows.push(element);
        });
      } catch {
        console.log("error fetching alertReport");
      }
    },
  },

  async created() {
        await this.fetchData();
    }
};
</script>
