<template>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <FlashMessage></FlashMessage>
    <ul class="navbar-nav ml-auto">
      <div v-if="taikhoan === null">
        <button type="button" class="btn btn-light" @click="dangnhap()">Đăng nhập</button>
        <button type="button" class="btn btn-primary" @click="dangky()">Đăng ký</button>
      </div>
      <div v-else>
        <div class="row">
          <div class="col-md-4">
            <el-badge :value="so_thong_bao" class="item">
              <el-dropdown trigger="click">
                <a href="#" @click="docThongBao()">
                  <img :src="taikhoan.anh_dai_dien" style="width: 60px; height:60px;" />
                </a>
                <el-dropdown-menu slot="dropdown">
                  <el-dropdown-item icon="el-icon-plus">Câu hỏi đã được duyệt</el-dropdown-item>
                </el-dropdown-menu>
              </el-dropdown>
            </el-badge>
          </div>
          <div class="col-md-8 dropdown">
            <button
              style="font-size: 14px"
              class="btn btn-secondary dropdown-toggle"
              type="button"
              id="dropdownMenuButton"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >{{taikhoan.name.substr(0, 11)}}</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="../canhan">Trang cá nhân</a>
              <a class="dropdown-item" href @click="dangxuat()">Đăng xuất</a>
            </div>
          </div>
        </div>
        <!-- <li class="nav-item dropdown">
          <a
            id="navbarDropdown"
            class="nav-link dropdown-toggle"
            href="#"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            v-pre
          >{{taikhoan.name}}</a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href>Đăng xuất</a>

            <form id="logout-form" action method="POST" style="display: none;"></form>
          </div>
        </li>-->
      </div>
    </ul>
  </div>
</template>
<script>
export default {
  data() {
    return {
      taikhoan: null,
      so_thong_bao: 12
    };
  },
  methods: {
    kiemTraDangNhap() {
      axios.get("../kiemtradangnhap").then(res => {
        this.taikhoan = res.data.data;
      });
    },
    docThongBao() {
      this.so_thong_bao = 5;
    },
    dangxuat() {
      axios.post("../logout").then(res => {});
      this.flashMessage.success({
        title: "Đăng xuất thành công",
        message: "Thành công",
        time: 5000
      });
    },
    dangky() {
      window.location.href = "register";
    },
    dangnhap() {
      window.location.href = "../login";
    }
  },
  created() {
    this.kiemTraDangNhap();
  }
};
</script>