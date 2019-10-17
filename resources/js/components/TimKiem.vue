<template>
  <div class="form-inline" style="width:45%; margin-left:70px">
    <input
      class="form-control mr-sm-2"
      type="search"
      placeholder="Tìm kiếm câu hỏi"
      aria-label="Search"
      style="width:60%"
      v-model="noidung"
    />
    <el-dropdown split-button type="success" @click="timkiem()">
      Tìm kiếm
      <el-dropdown-menu slot="dropdown">
        <el-dropdown-item>
          <div @click="timKiemNangCao()">
          <i class="el-icon-search"></i>
          Tìm kiếm nâng cao
          </div>
        </el-dropdown-item>
      </el-dropdown-menu>
    </el-dropdown>
  </div>
</template>
<script>
export default {
  data() {
    return {
      noidung: ""
    };
  },
  methods: {
    timkiem() {
      if(this.noidung != ''){
      window.location.href = `../timkiem/${this.noidung}`;
      }
    },
    timKiemNangCao() {
      window.location.href = '../timkiemnangcao';
    }
  }
};
</script>