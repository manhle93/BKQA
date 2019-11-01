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
                  <div v-for="thongbao in thongbaos">
                    <el-dropdown-item v-if="thongbao.user_tra_loi_id != null" style="margin-bottom: 5px">
                      <img :src="thongbao.user_tra_loi.anh_dai_dien" style="width: 50px; height:50px;" />
                      <a
                        :href="`/binhluan/${thongbao.cau_hoi_id}`"
                      >{{thongbao.user_tra_loi.name}} {{thongbao.noi_dung}}</a>
                    </el-dropdown-item>
                    <el-dropdown-item v-if="thongbao.user_tra_loi_id == null">
                      <img src="https://lh3.googleusercontent.com/ig3sXFVG-aX5Q5yPS_ioqyEDZ-SLwOMbKroa_g-D2u48lREZNE97_QpqZfh1kPIrzR0TBj0VZJFZQqQikbLZt-j4FP60eQMmmX6XuhwY5D7cORLWG1YKXmVQFloxlfeihQyPGNLupiXnlimC1DNH7opcKdNwFnoCkSiv1IBk1wKMF9iz9TdZrXMGXYX-DXMWy-flOQjqomquEbMMiMjvmHQ44AHULTEAPDHkk4lJYj_HJFu0apT5gKseIhQCserzb_3mA0n0TCaTmveKnOrgkmvszen6rshRRjQmgD22drv4EbdrwIHdwlPy2N7BLsBG0tVF2r_nxikw9RGiPsYvLe0TaaSZyGO0uSXPHuEM--fxSQP_nktENe6kZJMhkyGlmmW_egvAW8DG8cK8my_w21HDL0ADuoEOVMVJvWOqMGB5pGAsx-x0FzTY4mOLEqE1S8H0NmK-8YLEfIDYfkozG_7oP1l_knNCQFwGOFxz5_aMY0n38EcBenq_4Wh5liOfc1TEB3rNcx_mnE2UpoBnJ2Jc25Sc716-XUw-XN2ZTW97AwFi3P5k4fq2j9OKmpZGEJc-yaoyJm342tp-rMTpWci9g5h_6vx-MfVfGeVOiFuFwp2-R6oOw567FmoUQsTYayfp6BCARGNVvU7xkThWvrIqVV07TCTmAqY5flyvjsjhiUw7xmxEow=w416-h342-no" style="width: 50px; height:50px;" />
                      <a :href="`/binhluan/${thongbao.cau_hoi_id}`">{{thongbao.noi_dung}}</a>
                    </el-dropdown-item>
                  </div>
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
      so_thong_bao: 0,
      thongbaos: []
    };
  },
  methods: {
    kiemTraDangNhap() {
      axios.get("../kiemtradangnhap").then(res => {
        this.taikhoan = res.data.data;
      });
    },
    async getThongBao() {
      let data = await axios.get("/thongbao");
      this.thongbaos = data.data.data;
      this.so_thong_bao = this.taikhoan.so_thong_bao;
    },
    docThongBao() {
      this.so_thong_bao = 0;
      axios.post("/docthongbao");
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
      window.location.href = "/register";
    },
    dangnhap() {
      window.location.href = "../login";
    }
  },
  created() {
    this.kiemTraDangNhap();
    this.getThongBao();
    setInterval(()=> {
      this.kiemTraDangNhap();
      this.getThongBao();
    }, 4500);
  }
};
</script>