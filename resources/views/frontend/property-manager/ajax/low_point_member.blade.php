<div class="scroll_table">
<table class="table table-striped table-hover">
    <thead>
          <tr>
            <th scope="col">
               
            </th> 
            <th scope="col">Primary Member</th>
            <th scope="col">Building Name</th>
            <th scope="col">Unit</th>
            
            <th scope="col">Signed Up</th>
            <th scope="col">Account Term Date</th>
            <th scope="col">Points</th>
        </tr>
    </thead>
    <tbody>

    @if(@$alldatas)
        @foreach($alldatas as $property) 
        
                <tr class="low_balance_member">
                @if(@$property['consumer_unitid'] != '')
                <td><input class="form-check-input unitCheck" type="radio" name="unit" value="{{@$property['consumer_unitid']}}" id="flexCheckDefaultCon{{@$property['consumer_unitid']}}"/></td>
                @else
                <td><input class="form-check-input unitCheck" type="radio" name="unit" value="{{@$property['unitid']}}" id="flexCheckDefaultUnit{{@$property['unitid']}}"/></td>
                @endif
                @if(@$property['primary_member'] != 'Open')
                  <td>{{@$property['primary_member']}}</td>
                @else
                  <td><a href="javascript:void(0);" id="{{@$property['unitid']}}" class = "add_user_modal" >{{@$property['primary_member']}}</a></td>
                @endif
                <td>{{@$property['building_name']}}</td>
                <td>{{@$property['unit']}}</td>
                <td>{{@$property['signed_up']}}</td>
                <td>{{@$property['account_term_date']}}</td>
                <td style="color:red">{{@$property['point']}}</td>
            </tr>
        @endforeach
        @else
            @if($limitpoint != '')
                <tr>
                    <td colspan="4" style="text-align: center;">Low point balance point limit is set to: {{$limitpoint}} points</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">There are no members with low point balances</td>
                </tr>
            @else
                <tr>
                    <td colspan="4" style="text-align: center;">There are no members with low point balances</td>
                </tr>
            @endif
        @endif
       {{--<tr>
            <td>
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
            </td>
            <td>Building name 2</td>
            <td>1000-B</td>
            <td><a href="#">Add New Member</a></td>
            <td><img src="{{asset('frontend_assets/images/dashed.svg')}}" alt="img" /></td>
            <td><img src="{{asset('frontend_assets/images/dashed.svg')}}" alt="img" /></td>
            <td><img src="{{asset('frontend_assets/images/dashed.svg')}}" alt="img" /></td>
        </tr>
        <tr>
            <td>
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
            </td>
            <td>Building name 3</td>
            <td>1000-C</td>
            <td>Felix Sanders</td>
            <td>01/19/2018</td>
            <td class="red_text">01/19/2019</td>
            <td>690</td>
        </tr>
        <tr>
            <td>
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
            </td>
            <td>Building name 4</td>
            <td>1000-A</td>
            <td>Connie Faulk</td>
            <td>03/28/2018</td>
            <td class="red_text">03/19/2019</td>
            <td>75</td>
        </tr>
        <tr>
            <td>
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
            </td>
            <td>Building name 5</td>
            <td>1001-B</td>
            <td><a href="#">Add New Member</a></td>
            <td><img src="{{asset('frontend_assets/images/dashed.svg')}}" alt="img" /></td>
            <td><img src="{{asset('frontend_assets/images/dashed.svg')}}" alt="img" /></td>
            <td><img src="{{asset('frontend_assets/images/dashed.svg')}}" alt="img" /></td>
        </tr>
        <tr>
            <td>
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
            </td>
            <td>Building name 6</td>
            <td>1002-C</td>
            <td><a href="#">Add New Member</a></td>
            <td><img src="{{asset('frontend_assets/images/dashed.svg')}}" alt="img" /></td>
            <td><img src="{{asset('frontend_assets/images/dashed.svg')}}" alt="img" /></td>
            <td><img src="{{asset('frontend_assets/images/dashed.svg')}}" alt="img" /></td>
        </tr> --}}
    </tbody>
</table>
</div>