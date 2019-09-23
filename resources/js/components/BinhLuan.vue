<template>
  <div class="container" style="font-family: 'Open Sans';">
    <div>
      <FlashMessage></FlashMessage>
      <div class="row">
        <div class="col-md-1">
          <img :src="cauhoi.user.anh_dai_dien" style="width: 80px; height:80px" />
        </div>
        <div class="col-md-11">
          <p style="font-weight:bold; font-size: 20px">{{cauhoi.tieu_de}}</p>
          <p style="font-size: 18px ;">
            Tạo bởi: {{cauhoi.user.name}}
            <span
              style="margin-left: 20px"
            >Chủ đề: {{cauhoi.chu_de.tieu_de}}</span>
            <span style="margin-left: 20px">Thời gian: {{cauhoi.created_at}}</span>
          </p>
        </div>
      </div>
      <br />
      <p style="font-family: 'Open Sans'; font-size: 20px">{{cauhoi.noi_dung}}</p>
    </div>
    <hr />
    <div>
      <h4 style="font-family: 'Open Sans'; font-weight:bold">Trả lời</h4>
      <textarea rows="3" class="form-control" style="font-size: 20px" v-model="noi_dung"></textarea>
      <br />
      <button
        type="button"
        style="font-family: 'Open Sans'; font-size: 18px"
        @click="binhluan()"
        class="btn btn-primary"
      >Trả lời</button>
    </div>
    <hr />
    <div>
      <h4>{{cauhoi.so_cau_tra_loi}} Câu trả lời</h4>
      <br />
      <div v-for="cautraloi in cauhoi.cau_tra_lois">
        <div class="row">
          <div class="col-md-1">
            <img :src="cautraloi.user.anh_dai_dien" style="width: 60px; height: 60px" />
          </div>
          <div class="col-md-11">
            <p>
              <span style="font-weight:bold">{{cautraloi.user.name}}</span> Đã trả lời
            </p>
            <p>Thời gian: {{cautraloi.created_at}}</p>
          </div>
        </div>
        <p style="font-size: 20px">{{cautraloi.noi_dung}}</p>
        <hr />
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["cauhoi"],
  data() {
    return {
      noi_dung: ""
    };
  },
  created() {},
  methods: {
    binhluan() {
      axios
        .post(`/binhluan/${this.cauhoi.id}`, {
          noi_dung: this.noi_dung
        })
        .then(response => {
          this.flashMessage.success({
            title: "Đã gửi bình luận",
            message: "Thành công",
            time: 3000
          });
          setTimeout(() => {
            location.reload();
          }, 3000);
        });
    }
  }
};
</script>
<style scoped>
</style>