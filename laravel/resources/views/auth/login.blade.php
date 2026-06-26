<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Bootstrap 5 Login Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
      {{-- <img class="d-block mx-auto mb-2" src="https://scontent.fbkk11-1.fna.fbcdn.net/v/t39.30808-6/571106694_1116910117283254_4365383798501245279_n.jpg?stp=dst-jpg_tt6&cstp=mx958x958&ctp=s958x958&_nc_cat=104&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeElZY4qc07BsWAs1cuAC5iGN2qyimjys8g3arKKaPKzyH3aywmt2H55lHYl_DKORS4KH6cpMX4GGlNV4PIG_NTF&_nc_ohc=5UT_KjNa4UsQ7kNvwGTThMJ&_nc_oc=AdpzxE-pfbcPeIoJo4DMkEu6VdoNY7Ef85sQi5dPCH0PCAsUez7W0ltbZvlWhn1RCYg&_nc_zt=23&_nc_ht=scontent.fbkk11-1.fna&_nc_gid=hcbrBYCWN-twMM88c0rzXw&_nc_ss=792a8&oh=00_Af_yLWA3ofCrkac6K7jZRK1i7rgktIxpRPttKp1w6VASvQ&oe=6A3EA5BC" alt="" width="120vw" height="120vh"> --}}
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-2">เข้าสู่ระบบ</h1>
                            <p>สำนักวิเคราะห์และตรวจสอบ ขอความร่วมมือจากหน่วยงานที่มีการเจาะสำรวจชั้นดิน กรอกข้อมูลเพื่อรวบรวมเป็นชุดข้อมูลเดียวกันของกรมทางหลวง

</p>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									{{-- <label class="mb-2 text-muted" for="email">E-Mail Address</label> --}}
                                    {{-- <a id="social-one-login" class="pf-c-button pf-m-control pf-m-block kc-social-item kc-social-gray" type="button" href="https://onelogin.doh.go.th/login?code=a036d0efbeb1e8ab17d7a856d4a4eae55548fdc58761108d34c35d7dd130507a">
                                        <span class="kc-social-provider-name">
                                            Sign In with OneLogin
                                        </span>
                                    </a> --}}
                                    <a href="https://onelogin.doh.go.th/login?code=f222c4fe320923d0c1662b597194dfb5a88491574df70c8b0dc52b5718cd0fa8" class="btn btn-outline-primary d-flex align-items-center">
    <img src="https://data-auth-uat.doh.go.th/resources/mfxfi/login/doh/img/onelogin-logo.png" alt="Google" width="35" height="35" class="me-2">
    Sign In with OneLogin
</a>
									{{-- <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div> --}}
								</div>

								<div class="mb-3">
									{{-- <div class="mb-2 w-100">
										<label class="text-muted" for="password">Password</label>
										<a href="forgot.html" class="float-end">
											Forgot Password?
										</a>
									</div>
									<input id="password" type="password" class="form-control" name="password" required>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div> --}}
								</div>
                                {{dd(session()->all());}}
{{--
								<div class="d-flex align-items-center">
									<div class="form-check">
										<input type="checkbox" name="remember" id="remember" class="form-check-input">
										<label for="remember" class="form-check-label">Remember Me</label>
									</div>
									<button type="submit" class="btn btn-primary ms-auto">
										Login
									</button>
								</div> --}}
							</form>
						</div>
						{{-- <div class="card-footer py-3 border-0">
							<div class="text-center">
								Don't have an account? <a href="register.html" class="text-dark">Create One</a>
							</div>
						</div> --}}
					</div>
					{{-- <div class="text-center mt-5 text-muted mb-5">
						Copyright &copy; 2017-2021 &mdash; Your Company
					</div> --}}
				</div>
			</div>
		</div>
	</section>

	<script src="js/login.js"></script>
</body>
</html>
