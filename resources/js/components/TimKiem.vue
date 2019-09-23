<template>
  <div class="form-inline" style="width:45%; margin-left:70px">
    <input
      class="form-control mr-sm-2"
      type="search"
      placeholder="Tìm kiếm câu hỏi"
      aria-label="Search"
      style="width:80%"
      v-model="noidung"
    />
    <button class="btn btn-outline-success my-2 my-sm-0" @click="timkiem()">Tìm kiếm</button>
  </div>
</template>
<script>
export default {
  data() {
    return {
      noidung: ""
    }
  },
  methods: {
    timkiem() {
           window.location.href = `timkiem/${this.noidung}`;
    }
  }
};
</script>