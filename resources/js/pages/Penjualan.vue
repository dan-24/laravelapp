<template>
  <div>
    <v-toolbar flat>
      <v-toolbar-title>Transaksi Penjualan</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
    </v-toolbar>
    <v-autocomplete
      v-model="editedItem.barang"
      label="Nama Barang"
      :items="barang"
      item-text="nama_barang"
      item-value="id"
      return-object
    ></v-autocomplete>
    <v-text-field v-model="editedItem.jumlah" label="Jumlah"></v-text-field>
    <v-btn color="primary" @click="hitung">hitung</v-btn>
    <v-data-table :headers="headers" :items="datatable" class="elevation-1">
      <template v-slot:items="props">
        <td></td>
        <td>{{ props.item.barang.nama_barang }}</td>
        <td>{{ props.item.jumlah }}</td>
        <td>{{ props.item.barang.harga_jual }}</td>
        <td>{{ props.item.total }}</td>
        <td class="justify-center layout px-0">
          <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
          <v-icon small @click="deleteItem(props.item)">delete</v-icon>
        </td>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
      <template slot="footer">
        <td></td>
        <td></td>
        <td></td>
        <td>
          <strong>Sum</strong>
        </td>
        <td class="text-xs-right">{{ jumlahtotal}}</td>
      </template>
    </v-data-table>

    <v-btn color="primary" @click="bayar">Bayar</v-btn>
  </div>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    headers: [
      { text: "No", value: "name" },
      { text: "Nama Barang", value: "name" },
      { text: "Jumlah", value: "name" },
      { text: "Harga", value: "name" },
      { text: "Total", value: "name" },
      { text: "Actions", value: "name", sortable: false }
    ],

    datatable: [],
    barang: [],
    jumlahtotal: 0,

    editedIndex: -1,
    editedItem: {
      barang: {},
      jumlah: 0,
      total: 0
    },
    defaultItem: {
      name: "",
      id: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    }
    // totalAll() {
    //   return datatable.forEach(ju => {
    //     let t = +ju.total;
    //     return t;
    //   });
    //   return this.editedItem.jumlah * this.editedItem.barang.harga_jual;
    // }
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
      //axios.get("/api/nota").then(response => (this.userdata = response.data));
      axios
        .get("/api/barang")
        .then(response => (this.barang = response.data.data));
    },

    hitung() {
      if (this.editedIndex > -1) {
        this.editedItem.total =
          this.editedItem.jumlah * this.editedItem.barang.harga_jual;
        Object.assign(this.datatable[this.editedIndex], this.editedItem);
        this.editedIndex = -1;
      } else {
        this.datatable.push({
          barang: this.editedItem.barang,
          jumlah: this.editedItem.jumlah,
          total: this.editedItem.jumlah * this.editedItem.barang.harga_jual
        });
      }
      let u = 0;
      this.editedItem.barang = {};
      this.editedItem.jumlah = 0;
      this.datatable.forEach(uang => {
        u += uang.total;
      });
      this.jumlahtotal = u;
    },

    editItem(item) {
      this.editedIndex = this.datatable.indexOf(item);
      this.editedItem = Object.assign({}, item);
      //this.dialog = true;
      console.log(this.editedItem);
    },

    bayar() {
      const dagangan = [];
      this.datatable.forEach(data => {
        dagangan.push({
          barang_id: data.barang.id,
          nota_id: "A23",
          jumlah: data.jumlah,
          sub_total: data.total
        });
      });
      const transaksi = {
        kode: "A23",
        nama_pelanggan: "Test nama pelanggan",
        total: this.jumlahtotal,
        penjualans: dagangan
      };

      axios
        .post("/api/nota", transaksi)
        .then(res => {
          console.log(res);
        })
        .catch(err => console.log(err));
    },

    deleteItem(item) {
      const index = this.datatable.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.datatable.splice(index, 1);
      axios
        .delete("/api/nota/" + item.id)
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
        //axios.put("/api/nota/" + this.editedItem.id, this.editedItem);
      } else {
        this.datatable.push(this.editedItem);
        axios
          .post("/api/nota/", this.editedItem)
          .then(response => {
            console.log(response.data);
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
