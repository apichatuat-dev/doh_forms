@extends('layouts.app')

@section('content')
@dd(Auth::user())
    <div class="container">
        <main>
            <div class="py-2 text-center">
                <img class="d-block mx-auto mb-2"
                    src="https://scontent.fbkk11-1.fna.fbcdn.net/v/t39.30808-6/571106694_1116910117283254_4365383798501245279_n.jpg?stp=dst-jpg_tt6&cstp=mx958x958&ctp=s958x958&_nc_cat=104&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeElZY4qc07BsWAs1cuAC5iGN2qyimjys8g3arKKaPKzyH3aywmt2H55lHYl_DKORS4KH6cpMX4GGlNV4PIG_NTF&_nc_ohc=5UT_KjNa4UsQ7kNvwGTThMJ&_nc_oc=AdpzxE-pfbcPeIoJo4DMkEu6VdoNY7Ef85sQi5dPCH0PCAsUez7W0ltbZvlWhn1RCYg&_nc_zt=23&_nc_ht=scontent.fbkk11-1.fna&_nc_gid=hcbrBYCWN-twMM88c0rzXw&_nc_ss=792a8&oh=00_Af_yLWA3ofCrkac6K7jZRK1i7rgktIxpRPttKp1w6VASvQ&oe=6A3EA5BC"
                    alt="" width="120vw" height="120vh">
                <h2>แบบฟอร์มสำรวจข้อมูลหลุมเจาะสำรวจชั้นดิน</h2>
                <p class="">สำนักวิเคราะห์และตรวจสอบ ขอความร่วมมือจากหน่วยงานที่มีการเจาะสำรวจชั้นดิน
                    กรอกข้อมูลเพื่อรวบรวมเป็นชุดข้อมูลเดียวกันของกรมทางหลวง</p>
            </div>

            <div class="row g-5">

                <!-- Table -->
                <div class="table-responsive">
                    <!-- Toolbar -->
                    <div class="row mb-3">


                        <div class="col-md-6">
                            {{-- <div class="input-group">
                        <input type="text"
                               class="form-control"
                               placeholder="ค้นหาข้อมูล...">
                        <button class="btn btn-primary">
                            <i class="fa fa-search"></i> ค้นหา
                        </button>
                    </div> --}}
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('forms.create') }}" class="btn btn-success float-end">
                                <i class="fa fa-plus"></i> เพิ่มข้อมูล
                            </a>
                        </div>
                    </div>
                    <table id="usersTable" class="table table-striped table-hover">
                        <thead class="table-dark ">
                            <tr>
                                <th class="text-center">ลำดับ</th>
                                <th class="text-center">ชื่อโครงการ</th>
                                <th class="text-center">ชื่อจังหวัด</th>
                                <th class="text-center">พิกัด</th>
                                <th class="text-center">วันที่สำรวจ</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bording_logs as $key => $value)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td style="width: 400px;">{{ $value->project_name }}</td>
                                    <td class="text-center">{{ $value->province?->name_th }}</td>
                                    <td style="width: 100px" class="text-center"><a
                                            href="https://google.com">({{ $value->latitude }}, {{ $value->longtitude }})</a>
                                    </td>
                                    <td class="text-center">

                                        {{ \Carbon\Carbon::parse($value->hole_feature_date)->addYears(543)->format('d/m/Y') }}
                                    </td>
                                    <td class="text-center" style="width: 180px">
                                        <a href="{{ route('forms.edit', $value->gid) }}" class="btn btn-sm btn-warning"><i
                                                class="fa fa-pencil me-2"></i>แก้ไข</a>
                                        {{-- <button class="btn btn-sm btn-danger"><i class="fa fa-trash me-2"></i>ลบ</button> --}}
                                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $value->gid }}"
                                            data-project="{{ $value->project_name }}"
                                            data-date="{{ $value->hole_feature_date }}">
                                            <i class="fa fa-trash me-2"></i>ลบ
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                    <tr>
                        <th width="80">ลำดับ</th>
                        <th>รหัสหลุมเจาะ</th>
                        <th>โครงการ</th>
                        <th>จังหวัด</th>
                        <th>วันที่สำรวจ</th>
                        <th>ความลึก (เมตร)</th>
                        <th width="150">จัดการ</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>BH-001</td>
                        <td>ทางหลวงหมายเลข 1</td>
                        <td>กรุงเทพมหานคร</td>
                        <td>22/06/2026</td>
                        <td class="text-end">30.50</td>
                        <td class="text-center">

                             <button class="btn btn-warning btn-sm">
                                <i class="fa fa-pencil me-2"></i>แก้ไข
                            </button>

                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash me-2"></i>ลบ
                            </button>

                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">2</td>
                        <td>BH-002</td>
                        <td>ทางหลวงหมายเลข 4</td>
                        <td>นครปฐม</td>
                        <td>20/06/2026</td>
                        <td class="text-end">25.00</td>
                        <td class="text-center">

                            <button class="btn btn-warning btn-sm">
                                <i class="fa fa-pencil me-2"></i>แก้ไข
                            </button>

                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash me-2"></i>ลบ
                            </button>

                        </td>
                    </tr>
                    </tbody>
                </table> --}}
                </div>

            </div>
        </main>

        {{-- <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017–2021 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer> --}}
    </div>


    <!-- Modal ยืนยันการลบ -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">ยืนยันการลบข้อมูล</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>คุณต้องการลบข้อมูลนี้หรือไม่ ?</p>

                    <table class="table table-bordered">
                        <tr>
                            <th>ชื่อโครงการ</th>
                            <td id="project_name"></td>
                        </tr>
                        <tr>
                            <th>วันที่สำรวจ</th>
                            <td id="survey_date"></td>
                        </tr>
                    </table>
                </div>

                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            ยกเลิก
                        </button>

                        <button type="submit" class="btn btn-danger">
                            ยืนยันการลบ
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
