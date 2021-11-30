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
  name: "report-component",
  data() {
    return {
      columns: [
        {
          label: "ID",
          field: "id",
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
          label: "Direccion",
          field: "Address",
          type: "string",
        },
         {
          label: "Ciudad",
          field: "City",
          type: "string",
        },
        {
          label: "Telefono",
          field: "PhoneNumber",
          type: "number",
        },
           {
          label: "Correo",
          field: "Email",
          type: "string",
        },
        {
          label: "Fecha Registro",
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
        const { data } = await axios.get("appuserReport");
        console.log(data);
        data.forEach((element) => {
          this.rows.push(element);
        });
      } catch {
        console.log("error fetching appuserReport");
      }
    },
  },

  async created() {
        await this.fetchData();
    }
};
</script>
