<template>
  <div class="login-container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-center m-b-md">
          <h3>PLEASE LOGIN TO MOVIES APP</h3>
          <small>This is the best app ever!</small>
        </div>
        <div class="hpanel">
          <div class="panel-body">
            <form id="loginForm" method="POST" action="login">
              <img src="../../images/peliculas.jpg" class="img-responsive" alt="Responsive image" />
              <!--img src="logo-company" class="img-responsive" alt="Responsive image"-->

              <div class="form-group">
                <label class="control-label" for="email">Email</label>
                <input
                  type="text"
                  placeholder="example@gmail.com"
                  title="Please enter you email"
                  required
                  value
                  name="email"
                  id="email"
                  class="form-control"
                  v-model="login.email"
                />
                <span class="help-block small">Your unique email to app</span>
              </div>
              <div class="form-group">
                <label class="control-label" for="password">Password</label>
                <input
                  type="password"
                  title="Please enter your password"
                  placeholder="******"
                  required
                  value
                  name="password"
                  id="password"
                  class="form-control"
                  v-model="login.password"
                />

                <span class="help-block small">Yur strong password</span>
              </div>
              <div class="pretty p-svg p-curve p-rotate">
                <input type="checkbox" v-model="login.remember" />
                <div class="state p-success">
                  <!-- svg path -->
                  <svg class="svg svg-icon" viewBox="0 0 20 20">
                    <path
                      d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z"
                      style="stroke: white;fill:white;"
                    />
                  </svg>
                  <label>Remember login</label>
                </div>
              </div>
              <p class="help-block small">(if this is a private computer)</p>
              <button class="btn btn-primary btn-block btn-lg">Login</button>
              <!--a class="btn btn-default btn-block" href="#">Register</a-->
            </form>
          </div>
        </div>
        <!--pre>{{ $data }}</pre-->
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <strong>PELICULAS</strong> - VueJS WebApp
        <br />2020 Copyright Andres Velasquez Delgado
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      login: {
        email: "monkey.velasquez.1982@gmail.com",
        password: "Joker1982",
        remember: false
      }
    };
  },
  created: function() {
    var currentUrl = window.location.pathname;
    console.log(currentUrl);
  },
  mounted() {
    console.log("Component login mounted.");
  }
};
</script>
