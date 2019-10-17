<template>
  <div class="container" style="font-family: 'Open Sans'">
    <h2>Kết quả tìm kiếm cho: {{tukhoa}}</h2>
    <hr><br>
    <div v-for="cauhoi in ketqua">
      <div class="row">
        <div class="col-md-1">
          <img :src="cauhoi.user.anh_dai_dien" style="width: 80px; height:80px" />
        </div>
        <div class="col-md-11" style="font-size: 16px">
          <a :href="'/binhluan/'+ cauhoi.id">
            <h4 style>{{cauhoi.tieu_de}}</h4>
          </a>
          <p>
            Tạo bởi:
            <a :href="`../taikhoan/${cauhoi.user.id}`">{{cauhoi.user.name}}</a>
            <span style="margin-left: 20px">Chủ đề: {{cauhoi.chu_de.tieu_de}}</span>
            <span style="margin-left: 20px">Thời gian: {{cauhoi.created_at}}</span>
            <br />
            {{ketqua.so_cau_tra_loi}} trả lời
          </p>
        </div>
      </div>
      <p style="margin-top: px; font-size: 18px">{{cauhoi.noi_dung.substr(0, 250)}}...</p>
      <hr />
    </div>
  </div>
</template>
<script>
export default {
  props:{tukhoa : '', ketqua:{}},
  data() {
    return {};
  },
  mounted() {
    console.log(this.ketqua);
    console.log(this.tukhoa);
  }
};
</script>