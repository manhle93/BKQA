<template>
  <div class="container" style="font-family: 'Open Sans'">
    <div>
      <div class="row">
        <div class="col-md-3">
          <img :src="user.anh_dai_dien" style="width: 180px; height:180px" />
        </div>
        <div class="col-md-9">
          <h4 style="font-weight:bold; font-size: 24px">{{user.name}}</h4>
          <p style="font-size: 20px">Email: {{user.email}}</p>
          <p style="font-size: 20px">Ngày tham gia: {{user.created_at}}</p>
          <p style="font-size: 20px">Vai trò:</p>
        </div>
      </div>
    </div>
    <hr />
    <div>
      <div class="tabs">
        <a v-on:click="activetab=1" v-bind:class="[ activetab === 1 ? 'active' : '' ]">Bài viết</a>
      </div>

      <div class="content">
        <div v-if="activetab === 1" class="tabcontent">
          <div v-for="cauhoi in user.cau_hois">
            <div class="row">
              <div class="col-md-1">
                <img :src="user.anh_dai_dien" style="width: 80px; height:80px" />
              </div>
              <div class="col-md-10">
                <a :href="`../binhluan/${cauhoi.id}`">
                  <h4>{{cauhoi.tieu_de}}</h4>
                </a>
                <p style="font-size: 16px">
                  Tạo bởi:
                  {{user.name}}
                  <span
                    style="margin-left: 20px"
                  >Chủ đề: {{cauhoi.chu_de.tieu_de}}</span>
                  <span style="margin-left: 20px">Thời gian: {{cauhoi.created_at}}</span>
                </p>
                <p style="font-size: 18px">{{ cauhoi.noi_dung.substr(0, 200)}}...</p>
              </div>
              <div class="col-md-1">
                <el-tooltip class="item" effect="dark" content="Xóa" placement="top">
                  <el-button
                    v-if="user_login.quyen_id == 1 || user_login.quyen_id == 2"
                    @click="xoaCauHoi(cauhoi.id)"
                    type="danger"
                    icon="el-icon-delete"
                    circle
                  ></el-button>
                </el-tooltip>
              </div>
            </div>
            <hr />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["user"],
  data() {
    return {
      noi_dung: "",
      activetab: 1,
      cauhois: [],
      user_login: ""
    };
  },
  created() {
    this.taiKhoanDangNhap();
  },
  methods: {
    xoaCauHoi() {
      this.$confirm("Bạn có chắc chắn muốn xóa câu hỏi này?", "Xóa câu hỏi", {
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy",
        type: "warning"
      }).then(_ => {
        axios.delete(`/xoacauhoi/${this.cauhoi.id}`).then(res => {
          this.$message({
            message: "Đã xóa câu hỏi",
            type: "success"
          });
          setTimeout(() => {
            window.location.href = "/tatcacauhoi";
          }, 2000);
        });
      });
    },
    taiKhoanDangNhap() {
      axios.get("../kiemtradangnhap").then(res => {
        this.user_login = res.data.data;
      });
    }
  }
};
</script>
<style scoped>
/* RESET */

/* Style the tabs */
.tabs {
  overflow: hidden;
  margin-left: 20px;
  margin-bottom: -2px;
}

.tabs ul {
  list-style-type: none;
  margin-left: 20px;
}

.tabs a {
  float: left;
  cursor: pointer;
  padding: 12px 24px;
  transition: background-color 0.2s;
  border: 1px solid #ccc;
  border-right: none;
  background-color: #f1f1f1;
  border-radius: 10px 10px 0 0;
  font-weight: bold;
}
.tabs a:last-child {
  border-right: 1px solid #ccc;
}

/* Change background color of tabs on hover */
.tabs a:hover {
  background-color: #aaa;
  color: #fff;
}

/* Styling for active tab */
.tabs a.active {
  background-color: #fff;
  color: #484848;
  border-bottom: 2px solid #fff;
  cursor: default;
}

/* Style the tab content */
.tabcontent {
  padding: 30px;
  border: 1px solid #ccc;
  border-radius: 10px;
  box-shadow: 3px 3px 6px #e1e1e1;
}
</style>