@extends('layout.layout')
@section('content')


<div class="mt-4 mb-4 text-center">
    <h3 class="student_fac">Fee Payment</h3>
</div>

<!-- Address Div start -->
<div class="row row_margin px-2">
    <div class="col-lg-3 col-md-3">
  </div>
          <div class="col-lg-6 col-md-6 disha_back mb-4">
            <div class="d-flex media_fee">
                  <div class="col-lg-9 col-md-9 col-sm-12  text-white">
                
              <p class="mt-4"> <span class=" ms-5 current_color">Current Month:</span>  13th Jan 23 - Today  </p>
              <p>    <span class=" current_color ms-5">Subjects:</span> Mathematics, Science, English</p>
            </div> 
            <div lass="col-lg-3 col-md-3  col-sm-2">
                <img  class="mt-3 mx-3 dish_img" src="./asset/image/Fee_img.svg" alt="">
            </div>
        </div>

         </div>
  

</div>
<!-- Address Div end -->
<div class="row d-flex row_margin_data">
    
    <div class="col-lg-3"> </div>
    <div class="col-lg-6 d-flex justify-content-center">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active me-5 math_margin" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Mathematics</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link me-5 math_margin" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Science</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link me-5 math_margin" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">English</button>
  </li>

</ul>
</div>
<div class="tab-content" id="pills-tabContent">
  <!-- 1st code start -->
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0"><!-- calendcer area start-->
<div class="container">
    <div class="row justify-content-center align-items-start">
        <div class="col-sm-4 justify-content-center d-flex align-items-center">

        <div class="calendar mb-5">
            <div class="calendar-header">
                <span class="month-picker" id="month-picker">April</span>
                <div class="year-picker">
                    <span class="year-change" id="prev-year">
                        <pre><</pre>
                    </span>
                    <span id="year">2022</span>
                    <span class="year-change" id="next-year">
                        <pre>></pre>
                    </span>
                </div>
            </div>
            <div class="calendar-body">
                <div class="calendar-week-day">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="calendar-days"></div>
            </div>
           
            <div class="month-list"></div>
        </div>



    </div>


    <div class="col-md-4 ">
        <div class="Calender_data">  
       <p> <button class="calender_btn_yellow">25</button> <span class="mx-5 text_clor">Total classes taken</span></p>
       <p> <button class="calender_btn_green">21</button> <span class="mx-5 text_clor">Present</span></p>
       <p> <button class="calender_btn_red">04</button> <span class="mx-5 text_clor">Absent</span></p>
       <p> <button class="calender_btn_grey">02</button> <span class="mx-5 text_clor">Class not taken</span></p>
       
    </div>    
    </div>
<div class="col-md-4 ">
    <div class="row">
    <div>
       <div class="d-flex justify-content-between">
        <div>
        <p class="mathsdata">Mathematics</p>
        <p class="mathstext">Total Fee for Mathematics =</p>

    </div>
    <div>
        <p class="mathstext">25×cost per day</p>
        <p class="mathsboldtext">₹ 2200</p>

    </div>
       </div> 
    </div>
    </div>
    <hr class="m-0">
    <div class="row">
        <div>
           <div class="d-flex justify-content-between">
            <div>
            <p class="mathsdata">Science</p>
            <p class="mathstext">Total Fee for Science =</p>
    
        </div>
        <div>
            <p class="mathstext">25×cost per day</p>
            <p class="mathsboldtext">₹ 2050</p>
    
        </div>
           </div> 
        </div>
        </div>
        <hr class="m-0">
        <div class="row">
            <div>
               <div class="d-flex justify-content-between">
                <div>
                <p class="mathsdata">English</p>
                <p class="mathstext">Total Fee for English =</p>
        
            </div>
            <div>
                <p class="mathstext">25×cost per day</p>
                <p class="mathsboldtext"> ₹ 2000</p>
        
            </div>
               </div> 
            </div>
            </div>
            <hr class="m-0">
            <div class="row">
                <div>
                   <div class="d-flex justify-content-between">
                    <div>
                    <p class="totaldata">Total Fee:</p>
                  
            
                </div>
                <div>
                    <p class="mathsbold"> ₹ 6250</p>
            
                </div>
                   </div> 
                </div>
                </div>

</div>
<div class="row">
    <div class="justify-content-center d-flex mb-4">
            <button class="paymathbtn"><span class="text-white">Pay for Mathematics</span> </button>
            <button class="course_cancel mx-3  "><span class="coures-btn-text">Pay Total Fee</span> </button>
   
   </div>
</div>
<div class="text-center">
    <h3 class="mb-4 mt-5 paytext">Payment History</h3>
</div>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 teacher_margin">
        <table class="table tablebody">
            <thead class="tablehead text-center">
              <tr>
                <th class="th_border" scope="col">Duration</th>
                <th scope="col">Total No. of Classes</th>
                <th scope="col">Total Fee</th>
                <th class="th_border1" scope="col">Status</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <tr>
                <td>Dec 22 - Jan 23</td>
                <td>22</td>
                <td>2200/-</td>
                <td class="paidc">Paid</td>
              </tr>
              <tr>
                <td>Dec 22 - Jan 23</td>
                <td>22</td>
                <td>2200/-</td>
                <td class="paidc">Paid</td>
              </tr>
              <tr>
                <td>Dec 22 - Jan 23</td>
                <td> 22</td>
                <td>2200/-</td>
                <td class="paidc">Paid</td>
              </tr>
            </tbody>
          </table>
    </div>
    <div class="col-lg-2"></div>
</div>
</div>
</div>
<!-- calendcer area End-->
</div>

<!-- 2nd code start -->
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0"><!-- calendcer area start-->
<div class="container">
    <div class="row justify-content-center align-items-start">
        <div class="col-sm-4 justify-content-center d-flex align-items-center">

        <div class="calendar mb-5">
            <div class="calendar-header">
                <span class="month-picker" id="month-picker">April</span>
                <div class="year-picker">
                    <span class="year-change" id="prev-year">
                        <pre><</pre>
                    </span>
                    <span id="year">2022</span>
                    <span class="year-change" id="next-year">
                        <pre>></pre>
                    </span>
                </div>
            </div>
            <div class="calendar-body">
                <div class="calendar-week-day">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="calendar-days"></div>
            </div>
           
            <div class="month-list"></div>
        </div>



    </div>


    <div class="col-md-4 ">
        <div class="Calender_data">  
       <p> <button class="calender_btn_yellow">25</button> <span class="mx-5 text_clor">Total classes taken</span></p>
       <p> <button class="calender_btn_green">21</button> <span class="mx-5 text_clor">Present</span></p>
       <p> <button class="calender_btn_red">04</button> <span class="mx-5 text_clor">Absent</span></p>
       <p> <button class="calender_btn_grey">02</button> <span class="mx-5 text_clor">Class not taken</span></p>
       
    </div>    
    </div>
<div class="col-md-4 ">
    <div class="row">
    <div>
       <div class="d-flex justify-content-between">
        <div>
        <p class="mathsdata">Mathematics</p>
        <p class="mathstext">Total Fee for Mathematics =</p>

    </div>
    <div>
        <p class="mathstext">25×cost per day</p>
        <p class="mathsboldtext">₹ 2200</p>

    </div>
       </div> 
    </div>
    </div>
    <hr class="m-0">
    <div class="row">
        <div>
           <div class="d-flex justify-content-between">
            <div>
            <p class="mathsdata">Science</p>
            <p class="mathstext">Total Fee for Science =</p>
    
        </div>
        <div>
            <p class="mathstext">25×cost per day</p>
            <p class="mathsboldtext">₹ 2050</p>
    
        </div>
           </div> 
        </div>
        </div>
        <hr class="m-0">
        <div class="row">
            <div>
               <div class="d-flex justify-content-between">
                <div>
                <p class="mathsdata">English</p>
                <p class="mathstext">Total Fee for English =</p>
        
            </div>
            <div>
                <p class="mathstext">25×cost per day</p>
                <p class="mathsboldtext"> ₹ 2000</p>
        
            </div>
               </div> 
            </div>
            </div>
            <hr class="m-0">
            <div class="row">
                <div>
                   <div class="d-flex justify-content-between">
                    <div>
                    <p class="totaldata">Total Fee:</p>
                  
            
                </div>
                <div>
                    <p class="mathsbold"> ₹ 6250</p>
            
                </div>
                   </div> 
                </div>
                </div>

</div>
<div class="row">
    <div class="justify-content-center d-flex mb-4">
            <button class="paymathbtn"><span class="text-white">Pay for Mathematics</span> </button>
            <button class="course_cancel mx-3  "><span class="coures-btn-text">Pay Total Fee</span> </button>
   
   </div>
</div>
<div class="text-center">
    <h3 class="mb-4 mt-5 paytext">Payment History</h3>
</div>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 teacher_margin">
        <table class="table tablebody">
            <thead class="tablehead text-center">
              <tr>
                <th class="th_border" scope="col">Duration</th>
                <th scope="col">Total No. of Classes</th>
                <th scope="col">Total Fee</th>
                <th class="th_border1" scope="col">Status</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <tr>
                <td>Dec 22 - Jan 23</td>
                <td>22</td>
                <td>2200/-</td>
                <td class="paidc">Paid</td>
              </tr>
              <tr>
                <td>Dec 22 - Jan 23</td>
                <td>22</td>
                <td>2200/-</td>
                <td class="paidc">Paid</td>
              </tr>
              <tr>
                <td>Dec 22 - Jan 23</td>
                <td> 22</td>
                <td>2200/-</td>
                <td class="paidc">Paid</td>
              </tr>
            </tbody>
          </table>
    </div>
    <div class="col-lg-2"></div>
</div>
</div>
</div>
<!-- calendcer area End-->
</div>

<!-- 3rd code start -->
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0"><!-- calendcer area start-->
<div class="container">
    <div class="row justify-content-center align-items-start">
        <div class="col-sm-4 justify-content-center d-flex align-items-center">

        <div class="calendar mb-5">
            <div class="calendar-header">
                <span class="month-picker" id="month-picker">April</span>
                <div class="year-picker">
                    <span class="year-change" id="prev-year">
                        <pre><</pre>
                    </span>
                    <span id="year">2022</span>
                    <span class="year-change" id="next-year">
                        <pre>></pre>
                    </span>
                </div>
            </div>
            <div class="calendar-body">
                <div class="calendar-week-day">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="calendar-days"></div>
            </div>
           
            <div class="month-list"></div>
        </div>



    </div>


    <div class="col-md-4 ">
        <div class="Calender_data">  
       <p> <button class="calender_btn_yellow">25</button> <span class="mx-5 text_clor">Total classes taken</span></p>
       <p> <button class="calender_btn_green">21</button> <span class="mx-5 text_clor">Present</span></p>
       <p> <button class="calender_btn_red">04</button> <span class="mx-5 text_clor">Absent</span></p>
       <p> <button class="calender_btn_grey">02</button> <span class="mx-5 text_clor">Class not taken</span></p>
       
    </div>    
    </div>
<div class="col-md-4 ">
    <div class="row">
    <div>
       <div class="d-flex justify-content-between">
        <div>
        <p class="mathsdata">Mathematics</p>
        <p class="mathstext">Total Fee for Mathematics =</p>

    </div>
    <div>
        <p class="mathstext">25×cost per day</p>
        <p class="mathsboldtext">₹ 2200</p>

    </div>
       </div> 
    </div>
    </div>
    <hr class="m-0">
    <div class="row">
        <div>
           <div class="d-flex justify-content-between">
            <div>
            <p class="mathsdata">Science</p>
            <p class="mathstext">Total Fee for Science =</p>
    
        </div>
        <div>
            <p class="mathstext">25×cost per day</p>
            <p class="mathsboldtext">₹ 2050</p>
    
        </div>
           </div> 
        </div>
        </div>
        <hr class="m-0">
        <div class="row">
            <div>
               <div class="d-flex justify-content-between">
                <div>
                <p class="mathsdata">English</p>
                <p class="mathstext">Total Fee for English =</p>
        
            </div>
            <div>
                <p class="mathstext">25×cost per day</p>
                <p class="mathsboldtext"> ₹ 2000</p>
        
            </div>
               </div> 
            </div>
            </div>
            <hr class="m-0">
            <div class="row">
                <div>
                   <div class="d-flex justify-content-between">
                    <div>
                    <p class="totaldata">Total Fee:</p>
                  
            
                </div>
                <div>
                    <p class="mathsbold"> ₹ 6250</p>
            
                </div>
                   </div> 
                </div>
                </div>

</div>
<div class="row">
    <div class="justify-content-center d-flex mb-4">
            <button class="paymathbtn"><span class="text-white">Pay for Mathematics</span> </button>
            <button class="course_cancel mx-3  "><span class="coures-btn-text">Pay Total Fee</span> </button>
   
   </div>
</div>
<div class="text-center">
    <h3 class="mb-4 mt-5 paytext">Payment History</h3>
</div>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 teacher_margin">
        <table class="table tablebody ">
            <thead class="tablehead text-center">
              <tr>
                <th class="th_border" scope="col">Duration</th>
                <th scope="col">Total No. of Classes</th>
                <th scope="col">Total Fee</th>
                <th class="th_border1" scope="col">Status</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <tr>
                <td>Dec 22 - Jan 23</td>
                <td>22</td>
                <td>2200/-</td>
                <td class="paidc">Paid</td>
              </tr>
              <tr>
                <td>Dec 22 - Jan 23</td>
                <td>22</td>
                <td>2200/-</td>
                <td class="paidc">Paid</td>
              </tr>
              <tr>
                <td>Dec 22 - Jan 23</td>
                <td> 22</td>
                <td>2200/-</td>
                <td class="paidc">Paid</td>
              </tr>
            </tbody>
          </table>
    </div>
    <div class="col-lg-2"></div>
</div>
</div>
</div>
<!-- calendcer area End-->
</div>
 


    
    </div>
    <div class="col-lg-3"></div>
</div>

<!-- new code css -->


<script>
        let calendar = document.querySelector('.calendar')

        const month_names = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']

        isLeapYear = (year) => {
            return (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) || (year % 100 === 0 && year % 400 === 0)
        }

        getFebDays = (year) => {
            return isLeapYear(year) ? 29 : 28
        }

        generateCalendar = (month, year) => {

            let calendar_days = calendar.querySelector('.calendar-days')
            let calendar_header_year = calendar.querySelector('#year')

            let days_of_month = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]

            calendar_days.innerHTML = ''

            let currDate = new Date()
            if (month > 11 || month < 0) month = currDate.getMonth()
            if (!year) year = currDate.getFullYear()

            let curr_month = `${month_names[month]}`
            month_picker.innerHTML = curr_month
            calendar_header_year.innerHTML = year

            // get first day of month

            let first_day = new Date(year, month, 1)

            for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {
                let day = document.createElement('div')
                if (i >= first_day.getDay()) {
                    day.classList.add('calendar-day-hover')
                    day.innerHTML = i - first_day.getDay() + 1
                    day.innerHTML += `<span></span>
                            <span></span>
                            <span></span>
                            <span></span>`
                    if (i - first_day.getDay() + 1 === currDate.getDate() && year === currDate.getFullYear() && month === currDate.getMonth()) {
                        day.classList.add('curr-date')
                    }
                }
                calendar_days.appendChild(day)
            }
        }

        let month_list = calendar.querySelector('.month-list')

        month_names.forEach((e, index) => {
            let month = document.createElement('div')
            month.innerHTML = `<div data-month="${index}">${e}</div>`
            month.querySelector('div').onclick = () => {
                month_list.classList.remove('show')
                curr_month.value = index
                generateCalendar(index, curr_year.value)
            }
            month_list.appendChild(month)
        })

        let month_picker = calendar.querySelector('#month-picker')

        month_picker.onclick = () => {
            month_list.classList.add('show')
        }

        let currDate = new Date()

        let curr_month = {
            value: currDate.getMonth()
        }
        let curr_year = {
            value: currDate.getFullYear()
        }

        generateCalendar(curr_month.value, curr_year.value)

        document.querySelector('#prev-year').onclick = () => {
            --curr_year.value
            generateCalendar(curr_month.value, curr_year.value)
        }

        document.querySelector('#next-year').onclick = () => {
            ++curr_year.value
            generateCalendar(curr_month.value, curr_year.value)
        }
    </script>


  @endsection