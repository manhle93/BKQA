<template>
  <div>
    <el-dialog :visible.sync="showThemChude" @close="close()" title="CẬP NHẬT THÔNG TIN">
      <el-form
        :label-position="labelPosition"
        label-width="100px"
        :model="formLabelAlign"
        :rules="rules"
        ref="formLabelAlign"
      >
        <el-row :gutter="20" justify="space-around">
          <el-col>
            <el-form-item prop="tieu_de">
              <label style="font-size: 18px; font-weight: bold">Tên chủ đề</label>
              <el-input size="large" v-model="formLabelAlign.tieu_de" placeholder="Nhập tên chủ đề"></el-input>
            </el-form-item>
          </el-col>
          <el-col>
            <el-form-item prop="mo_ta">
              <label style="font-size: 18px; font-weight: bold">Mô tả</label>
              <br />
              <textarea
                size="large"
                style="width: 100%"
                v-model="formLabelAlign.mo_ta"
                rows="2"
                placeholder="Thông tin mô tả về chủ đề"
              ></textarea>
            </el-form-item>
          </el-col>
          <el-button
            type="primary"
            style="width:100%;"
            :loading="loading"
            @click="submit('formLabelAlign')"
          >THÊM</el-button>
        </el-row>
      </el-form>
    </el-dialog>
  </div>
</template>
<script>
export default {
  name: "SuaChude",
  data() {
    return {
      chuDe_id: 0,
      loading: false,
      labelPosition: "top",
      showThemChude: false,
      formLabelAlign: {
        tieu_de: "",
        mo_ta: ""
      },
      rules: {
        tieu_de: [
          {
            required: true,
            message: "Tên chủ đề không được bỏ trống",
            trigger: "blur"
          },
          { min: 2, message: "chủ đề tối thiểu 2 ký tự", trigger: "blur" }
        ],
        mo_ta: [
          {
            required: true,
            message: "Nội dung mô tả không được bỏ trống",
            trigger: "blur"
          },
          {
            min: 3,
            message: "Nội dung mô tả tối thiểu 3 ký tự",
            trigger: "blur"
          }
        ]
      }
    };
  },
  props: {
    active: {
      type: Boolean,
      default: false
    },
    ChuDeEdit: {
        type: Object,
    }
  },
  watch: {
    active(val) {
      this.showThemChude = val;
    },
    ChuDeEdit(val) {
      this.chuDe_id = val.id;
      this.formLabelAlign = val;
    }
  },
  methods: {
    close() {
      this.$emit("onClose");
    },
    submit(create) {
      this.$refs[create].validate(valid => {
        if (valid) {
          axios.post(`suachude/${this.chuDe_id}`, this.formLabelAlign).then(res => {
            this.loading = false;
            this.$emit("onEditChude", true);
          });
        } else {
          return false;
        }
      });
    }
  }
};
</script>
<style>
</style>
