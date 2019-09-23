<template>
  <div class="container">
    <notifications position="top center" group="foo" />
    <div class="form-group">
      <label>Tiêu đề</label>
      <input class="form-control" v-model="tieu_de" name="tieu_de" placeholder="Tiêu đề câu hỏi" />
    </div>
    <div>
      <label>Chủ đề</label>
      <multiselect
        v-model="chu_de"
        :options="chude"
        placeholder="Chọn chủ đề"
        label="tieu_de"
        track-by="id"
      ></multiselect>
    </div>
    <div class="form-group">
      <label>Nội dung</label>
      <textarea class="form-control" v-model="noi_dung" name="noi_dung" rows="3"></textarea>
    </div>
    <button type="button" class="btn btn-primary" @click="submit()">ĐĂNG</button>
  </div>
</template>
<script>
import Multiselect from "vue-multiselect";
// register globally
Vue.component("multiselect", Multiselect);
export default {
  props: ["chudes"],
  data() {
    return {
      chude: [],
      tieu_de: "",
      chu_de: "",
      noi_dung: ""
    };
  },
  created() {
    this.chude = this.chudes;
  },
  methods: {
    submit() {
      axios
        .post("/nhapcauhoi", {
          tieu_de: this.tieu_de,
          chu_de_id: this.chu_de.id,
          noi_dung: this.noi_dung
        })
        .then(response => {
          this.$swal({
            position: "top-center",
            type: "success",
            title: "Đã gửi câu hỏi",
            showConfirmButton: false,
            timer: 1500
          });
          window.location.href = "/tatcacauhoi";
        });
    }
  }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>