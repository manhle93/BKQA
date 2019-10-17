<template>
  <div class="container">
    <notifications position="top center" group="foo" />
    <el-form :model="formCauHoi" :rules="rules" ref="formCauHoi">
      <el-form-item prop="tieu_de">
        <label style="font-size:16px; font-weight: bold">Tiêu đề</label>
        <input class="form-control" v-model="formCauHoi.tieu_de" placeholder="Tiêu đề câu hỏi" />
      </el-form-item>
      <el-form-item prop="chu_de">
        <label style="font-size:16px; font-weight: bold">Chủ đề</label><br>
        <el-select v-model="formCauHoi.chu_de_id" placeholder="Select">
          <el-option v-for="item in chude" :key="item.id" :label="item.tieu_de" :value="item.id"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item prop="noi_dung">
        <label style="font-size:16px; font-weight: bold">Nội dung</label>
        <textarea class="form-control" v-model="formCauHoi.noi_dung" rows="3"></textarea>
      </el-form-item>
      <button type="button" class="btn btn-primary" @click="submit('formCauHoi')">ĐĂNG</button>
    </el-form>
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
      formCauHoi: {
        tieu_de: "",
        chu_de: "",
        noi_dung: "",
        chu_de_id: ""
      },
      chude: [],
      rules: {
        tieu_de: [
          {
            required: true,
            message: "Tiêu đề không thể bỏ trống",
            trigger: "blur"
          },
          { min: 3, message: "Tiêu đề tối thiểu 3 ký tự", trigger: "blur" }
        ],
        chu_de_id: [
          {
            required: true,
            message: "Chủ đề không thể bỏ trống",
            trigger: "blur"
          }
        ],
        noi_dung: [
          {
            required: true,
            message: "Nội dung không thể bỏ trống",
            trigger: "blur"
          },
          { min: 5, message: "Nội dung tối thiểu 5 ký tự", trigger: "blur" }
        ]
      }
    };
  },
  created() {
    this.chude = this.chudes;
  },
  methods: {
    submit(e) {
      this.$refs[e].validate(valid => {
        if (valid) {
          axios.post("/nhapcauhoi", this.formCauHoi).then(response => {
            this.$swal({
              position: "top-center",
              type: "success",
              title: "Đã gửi câu hỏi",
              showConfirmButton: false,
              timer: 1500
            });
            (this.formCauHoi.noi_dung = ""),
              (this.formCauHoi.chu_de_id = ""),
              (this.formCauHoi.tieu_de = "");
          });
        } else {
          console.log("error submit!!");
          return false;
        }
      });
    }
  }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>