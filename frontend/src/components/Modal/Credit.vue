<template>
  <div
    class="modal fade"
    id="creditModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Кредит готівкою на картку
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="card shadow-lg p-3 mb-5 bg-white rounded">
            <div class="card-body">
              <h6 class="card-subtitle mb-2 text-muted">Необхідна сума</h6>
              <div class="d-flex">
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                  :placeholder="total"
                  v-model="total"
                />
                <div class="uah colo">UAH</div>
              </div>
              <div class="con">
                <div class="term">Термін кредита</div>
                <div class="sum">10 міс.</div>
              </div>
              <div class="con">
                <div class="rate">Щомісячна % ставка</div>
                <div class="val">2,9%</div>
              </div>
              <div class="con">
                <div class="rate">Щомісячний платіж</div>
                <div class="val">{{ rate }}</div>
              </div>
            </div>
          </div>
          <div v-if="isSuccess" class="text-success">Успiшно</div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary me-2" @click="send">
              Оформити
            </button>
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Закрити
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Credit",
  computed: {
    rate() {
      return parseFloat((this.total / 10) * 0.29 + this.total / 10);
    }
  },
  data() {
    return {
      total: "1000",
      isSuccess: false
    };
  },
  methods: {
    send() {
      const userId = this.$route.params.id ?? this.userData.id;

      this.isSuccess = false;
      this.$axios
        .post("/users/" + userId + "/credits", {
          total: this.total
        })
        .then(() => {
          this.isSuccess = true;
        });
    }
  }
};
</script>

<style lang="scss">
.colo {
  color: grey;
}
.con {
  display: flex;
  justify-content: space-between;
  color: grey;
  font-weight: 500;
  padding-top: 5px;
}
.wid {
  width: 70%;
}
.uah {
  padding-left: 5px;
}
</style>
