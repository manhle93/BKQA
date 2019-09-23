<template>
    <div>
        <h2>Kết quả tìm kiếm</h2>
    </div>
</template>
<script>
export default {
      props: ["tukhoa", "ketqua"],
      data(){
          return {}
      },
      created(){
          console.log(this.ketqua)
          console.log(this.tukhoa)
      }

}
</script>