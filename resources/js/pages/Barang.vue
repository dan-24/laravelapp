<template>
  <div>
    <v-toolbar flat>
      <v-toolbar-title>Barang</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark class="mb-2" v-on="on">Barang Baru</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.nama_barang" label="Nama Barang"></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-select
                    v-model="editedItem.kategori_id"
                    :items="kategori"
                    label="Kategori"
                    item-text="nama_kategori"
                    item-value="id"
                    chips
                  ></v-select>
                </v-flex>
                <v-flex xs12>
                  <v-select
                    v-model="editedItem.suplier_id"
                    :items="suplier"
                    label="Suplier"
                    item-text="nama_perusahaan"
                    item-value="id"
                    chips
                  ></v-select>
                </v-flex>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.stock" label="Jumlah"></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.harga_beli" label="Harga Beli"></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.harga_jual" label="Harga Jual"></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.keterangan" label="Keterangan"></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
            <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-data-table :headers="headers" :items="datatable" class="elevation-1">
      <template v-slot:items="props">
        <td>{{ props.item.nama_barang }}</td>
        <td>{{ props.item.stock }}</td>
        <td>{{ props.item.harga_beli }}</td>
        <td>{{ props.item.harga_jual }}</td>
        <td class="justify-center layout px-0">
          <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
          <v-icon small @click="deleteItem(props.item)">delete</v-icon>
        </td>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    headers: [
      { text: "Nama Barang", value: "name" },
      { text: "Stock", value: "name" },
      { text: "Harga Beli", value: "name" },
      { text: "Harga Jual", value: "name" },
      { text: "Actions", value: "name", sortable: false }
    ],

    datatable: [],
    suplier: [],
    kategori: [],
    editedIndex: -1,
    editedItem: {
      nama_barang: "",
      kategori_id: "",
      suplier_id: "",
      stock: "",
      harga_beli: "",
      harga_jual: "",
      keterangan: ""
    },
    defaultItem: {
      nama_barang: "",
      kategori_id: "",
      suplier_id: "",
      stock: "",
      harga_beli: "",
      harga_jual: "",
      keterangan: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      axios.get("/api/barang").then(response => {
        this.datatable = response.data.data;
        console.log(response.data.data);
      });
      axios.get("/api/kategori").then(response => {
        this.kategori = response.data.data;
        console.log(response.data.data);
      });
      axios.get("/api/suplier").then(response => {
        this.suplier = response.data.data;
        console.log(response.data.data);
      });
    },

    // selectimage() {
    //   document.getElementById("image-field").click();
    // },

    // unpdatepicture(e) {
    //   var reader,
    //     file = e.target.files;

    //   if (file.length === 0) {
    //     console.log("empty");
    //   }

    //   reader = new FileReader();

    //   reader.onload = e => {
    //     this.imagepreview = e.target.result;
    //   };

    //   reader.readAsDataURL(file[0]);
    // },

    editItem(item) {
      this.editedIndex = this.datatable.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.datatable.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.datatable.splice(index, 1);
      axios
        .delete("/api/keterangan/" + item.id)
        .then(response => console.log(response.data));
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.datatable[this.editedIndex], this.editedItem);
        axios
          .put("/api/barang/" + this.editedItem.id, this.editedItem)
          .then(res => console.log(res))
          .catch(err => console.log(err));
      } else {
        console.log(this.editedItem);
        axios
          .post("/api/barang", this.editedItem)
          .then(response => {
            console.log(response.data);
            this.datatable.push(response.data.data);
          })
          .catch(err => console.log(err));
      }
      this.close();
    }
  }
};
</script>

<style>
</style>

