<template>
  <div class="user_page">
    <nav class="navbar navbar-light bg-white shadow p-3 mb-5 bg-white rounded">
      <div class="container-fluid">
        <router-link to="/" class="nav_logo">ПриватPRO</router-link>
        <div class="">
          <!-- <div class="form-check form-switch">
            <input
              class="form-check-input bgc"
              type="checkbox"
              id="flexSwitchCheckDefault"
            />
          </div> -->
        </div>
        <Logout />
      </div>
    </nav>
    <div>
      <div
        v-if="!hasRoleManager"
        class="card_pos d-flex justify-content-center"
      >
        <section
          class="user_card mt-4 shadow-sm p-3 mb-5 bg-white rounded border border-dark"
        >
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <h3>Повідомлення (Перекази)</h3>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <div>
            <table
              class="table table-light table-bordered border-secondary mt-3"
            >
              <thead>
                <tr>
                  <th scope="col">Дата</th>
                  <th scope="col">З карти</th>
                  <th scope="col">На карту</th>
                  <th scope="col">Опис</th>
                  <th scope="col">Сума</th>
                  <th scope="col">Статус</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="paymentsConfirmation in paymentsConfirmations"
                  :key="paymentsConfirmation.id"
                >
                  <template
                    v-if="
                      paymentsConfirmation.confirmation?.is_confirmation === 0
                    "
                  >
                    <td>{{ paymentsConfirmation.createdAt }}</td>
                    <td>{{ paymentsConfirmation.fromCard.number }}</td>
                    <td>{{ paymentsConfirmation.toCard.number }}</td>
                    <td>{{ paymentsConfirmation.description }}</td>
                    <td>{{ paymentsConfirmation.total }}</td>
                    <td>
                      <button
                        class="btn btn-outline-dark"
                        @click="paymentConfirm(paymentsConfirmation.id)"
                      >
                        Підтвердити
                      </button>
                    </td>
                  </template>
                </tr>
              </tbody>
            </table>
          </div>
        </section>
      </div>
      <div
        v-if="!hasRoleManager"
        class="card_pos d-flex justify-content-center"
      >
        <section
          class="user_card mt-4 shadow-sm p-3 mb-5 bg-white rounded border border-dark"
        >
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <h3>Повідомлення (Кредити)</h3>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <div>
            <table
              class="table table-light table-bordered border-secondary mt-3"
            >
              <thead>
                <tr>
                  <th scope="col">Дата</th>
                  <th scope="col">Видано на (місяців)</th>
                  <th scope="col">Щомісячний платіж</th>
                  <th scope="col">Сума</th>
                  <th scope="col">Статус</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="creditsConfirmation in creditsConfirmations"
                  :key="creditsConfirmation.id"
                >
                  <template
                    v-if="
                      creditsConfirmation.confirmation?.is_confirmation === 0
                    "
                  >
                    <td>{{ creditsConfirmation.createdAt }}</td>
                    <td>{{ creditsConfirmation.time }}</td>
                    <td>{{ creditsConfirmation.rate }}</td>
                    <td>{{ creditsConfirmation.total }}</td>
                    <td>
                      <button
                        class="btn btn-outline-dark"
                        @click="creditConfirm(creditsConfirmation.id)"
                      >
                        Підтвердити
                      </button>
                    </td>
                  </template>
                </tr>
              </tbody>
            </table>
          </div>
        </section>
      </div>
      <div class="card_pos d-flex justify-content-center">
        <section
          class="user_card shadow-sm pt-4 p-5 mb-3 bg-white rounded border border-dark"
        >
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <h3>Профіль</h3>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <div class="container">
            <div class="row">
              <div class="col-4 move">
                <div class="card user_image">
                  <img
                    src="../image/user.png"
                    class="card-img-top defoult_image"
                    alt="Фото користувача"
                  />
                </div>
                <div
                  v-if="
                    userData?.roles?.find((item) => item.title === 'Manager')
                  "
                  class="editButton"
                >
                  <button
                    type="button"
                    class="btn btn-outline-dark"
                    data-bs-toggle="modal"
                    data-bs-target="#editModal"
                  >
                    Редагувати
                  </button>
                </div>
                <Edit :user="user" />
              </div>
              <div class="col-5 move">
                <div class="profile-info">
                  <ul class="list-group">
                    <li class="list-group-item leave">
                      <b>Прізвище:</b>
                      {{ user?.lastName }}
                    </li>
                    <li class="list-group-item leave">
                      <b>Ім`я:</b>
                      {{ user?.firstName }}
                    </li>
                    <li class="list-group-item leave">
                      <b>По батькові:</b>
                      {{ user?.middleName }}
                    </li>
                    <li class="list-group-item leave">
                      <b>Дата народження:</b>
                      {{ user?.birth }}
                    </li>
                    <li class="list-group-item leave">
                      <b>Номер телефону:</b>
                      {{ user?.phone }}
                    </li>
                    <li class="list-group-item leave">
                      <b>Email:</b>
                      {{ user?.email }}
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-3 move">
                <ul class="list-group">
                  <li class="list-group-item">
                    <button
                      type="button"
                      class="btn btn-outline-dark marg"
                      data-bs-toggle="modal"
                      data-bs-target="#paymentModal"
                    >
                      Переказ
                    </button>
                  </li>
                  <Payment v-if="$route.params.id ?? userData.id" />
                  <li
                    v-if="
                      userData?.roles?.find((item) => item.title === 'Manager')
                    "
                    class="list-group-item"
                  >
                    <button
                      type="button"
                      class="btn btn-outline-dark marg"
                      data-bs-toggle="modal"
                      data-bs-target="#creditModal"
                    >
                      Кредит
                    </button>
                  </li>
                  <Credit />
                </ul>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="card_pos d-flex justify-content-center">
        <section
          class="user_card mt-4 shadow-sm p-3 mb-5 bg-white rounded border border-dark"
        >
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <h3>Історія платежів</h3>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <div>
            <table
              class="table table-light table-bordered border-secondary mt-3"
            >
              <thead>
                <tr>
                  <th scope="col">Дата</th>
                  <th scope="col">З карти</th>
                  <th scope="col">На карту</th>
                  <th scope="col">Опис</th>
                  <th scope="col">Сума</th>
                  <th scope="col">Статус</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="payment in payments" :key="payment.id">
                  <td>{{ payment.createdAt }}</td>
                  <td>{{ payment.fromCard.number }}</td>
                  <td>{{ payment.toCard.number }}</td>
                  <td>{{ payment.description }}</td>
                  <td>{{ payment.total }}</td>
                  <td>{{ payment.status }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>
      </div>
      <div class="card_pos d-flex justify-content-center">
        <section
          class="user_card mt-4 shadow-sm p-3 mb-5 bg-white rounded border border-dark"
        >
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <h3>Історія кредитiв</h3>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <div>
            <table
              class="table table-light table-bordered border-secondary mt-3"
            >
              <thead>
                <tr>
                  <th scope="col">Дата</th>
                  <th scope="col">Видано на (місяців)</th>
                  <th scope="col">Щомісячний платіж</th>
                  <th scope="col">Сума</th>
                  <th scope="col">Статус</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="credit in credits" :key="credit.id">
                  <td>{{ credit.createdAt }}</td>
                  <td>{{ credit.time }}</td>
                  <td>{{ credit.rate }}</td>
                  <td>{{ credit.total }}</td>
                  <td>{{ credit.status }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

import Credit from "../components/Modal/Credit";
import Edit from "../components/Modal/Edit";
import Payment from "../components/Modal/Payment";
import Logout from "./Logout.vue";

export default {
  name: "Profile",
  components: {
    Credit,
    Edit,
    Payment,
    Logout,
  },
  computed: {
    ...mapGetters("user", ["userData"]),

    hasRoleManager() {
      return this.userData.roles.find((item) => item.title === "Manager");
    },
  },
  data() {
    return {
      user: {},
      payments: [],
      credits: [],
      paymentsConfirmations: [],
      creditsConfirmations: [],
    };
  },
  methods: {
    getUser() {
      const userId = this.$route.params.id ?? this.userData.id;

      if (userId) {
        this.$axios.get("users/" + userId).then((response) => {
          this.user = response.data.data;
        });
      }
    },
    getPayments() {
      const userId = this.$route.params.id ?? this.userData.id;

      if (userId) {
        this.$axios.get("users/" + userId + "/payments").then((response) => {
          this.payments = response.data.data;
        });
      }
    },
    getCredits() {
      const userId = this.$route.params.id ?? this.userData.id;

      if (userId) {
        this.$axios.get("users/" + userId + "/credits").then((response) => {
          this.credits = response.data.data;
        });
      }
    },
    getPaymentsConfirmations() {
      const userId = this.$route.params.id ?? this.userData.id;

      if (userId) {
        this.$axios
          .get("users/" + userId + "/payments/confirmations")
          .then((response) => {
            this.paymentsConfirmations = response.data.data;
          });
      }
    },
    paymentConfirm(paymentId) {
      const userId = this.$route.params.id ?? this.userData.id;

      if (userId) {
        this.$axios
          .get("users/" + userId + "/payments/" + paymentId + "/confirm")
          .then((response) => {
            console.log(response);
          });
      }
    },
    getCreditsConfirmations() {
      const userId = this.$route.params.id ?? this.userData.id;

      if (userId) {
        this.$axios
          .get("users/" + userId + "/credits/confirmations")
          .then((response) => {
            this.creditsConfirmations = response.data.data;
          });
      }
    },
    creditConfirm(creditId) {
      const userId = this.$route.params.id ?? this.userData.id;

      if (userId) {
        this.$axios
          .get("users/" + userId + "/credits/" + creditId + "/confirm")
          .then((response) => {
            console.log(response);
          });
      }
    },
  },
  mounted() {
    if (this.hasRoleManager) {
      if (this.$route.params.id) {
        this.getUser();
      } else {
        this.$router.push({ name: "SearchPage" });
      }
    } else {
      this.user = this.userData;
    }

    this.getPayments();
    this.getCredits();
    this.getPaymentsConfirmations();
    this.getCreditsConfirmations();
  },
};
</script>

<style lang="scss">
.bgc:checked {
  background-color: black;
  border-color: white;
}
.defoult_image {
  width: 10rem;
  height: 10rem;
}
.leave {
  padding: 5px 0px;
}
.move {
  padding-left: 40px;
  padding-top: 20px;
}
.editButton {
  padding-left: 21px;
  padding-top: 20px;
}
.user_page {
  width: 100%;
}
.nav_logo {
  text-decoration: none;
  color: #000000;
  font-size: 25px;
  font-weight: 700;
  padding-left: 15px;
}
.nav_logo:hover {
  color: #000000;
}
a:hover {
  font-weight: 700;
}
.user_card {
  width: 70%;
  background-color: #ffffff;
}
.user_info {
  padding-left: 50px;
}
.list-group-item {
  border: none;
}
.user_image {
  width: 10rem;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  z-index: 1;
}
</style>
