// Call the dataTables jQuery plugin
$(document).ready(function() {
     var baseURL=$('#base_url').val();
  //$('#dataTable').DataTable();
    //var tokenData = $('#tokenhash').val();
    //console.log(baseURL);
  if($('#userTable').length){
    var dataTable = $('#userTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': false,
      "ajax": {
        url: baseURL + "administrator/get-users",
        type: 'POST',
        'data': function(data){
          // Append to data
          data.searchName = $('#searchName').val(),
          data.searchByStatus = $('#userStatus').val(),
          data.csrf_poliscore_name = $('.athletecsrf').val()
      },complete(res){
        $('.athletecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'name' },
        { data: 'email' },
        { data: 'phone' },
        { data: 'driving_licince' },  
        { data: 'status' },
        { data: 'action' },
      ]
    });

    $('#searchName').keyup(function(){
      dataTable.draw();
    });

    $('#userStatus').change(function(){
      dataTable.draw();
    });
  }

  if($('#politicianTable').length){
    var dataTablepolitician = $('#politicianTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': false,
      "ajax": {
        url: baseURL + "administrator/get-politician",
        type: 'POST',
        'data': function(data){
          // Append to data
        
          data.searchName = $('#searchNamepolitician').val(),
          data.searchByStatus = $('#politicianStatus').val(),
          data.csrf_poliscore_name = $('.politiciancsrf').val()
      },complete(res){
        console.log(res);
        $('.politiciancsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'name' },
        { data: 'email' },
        { data: 'phone' },
        { data: 'chamber' },
        { data: 'driving_licince' },
        { data: 'profile_clamed' },
        { data: 'status' },
        { data: 'action' },
    ]
    } );

    $('#searchNamepolitician').keyup(function(){
      dataTablepolitician.draw();
    });

    $('#politicianStatus').change(function(){
      dataTablepolitician.draw();
    });
  }

  if($('#politiciancandidateTable').length){
    var dataTablepoliticiancandidate = $('#politiciancandidateTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': false,
      "ajax": {
        url: baseURL + "administrator/get-candidate-politician",
        type: 'POST',
        'data': function(data){
          // Append to data
        
          data.searchName = $('#searchNamepolitician').val(),
          data.searchByStatus = $('#politicianStatus').val(),
          data.csrf_poliscore_name = $('.politiciancsrf').val()
      },complete(res){
        console.log(res);
        $('.politiciancsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'name' },
        { data: 'email' },
        { data: 'phone' },
        { data: 'chamber' },
        { data: 'driving_licince' },
        { data: 'profile_clamed' },
        { data: 'status' },
        { data: 'action' },
    ]
    } );





    $('#searchNamepolitician').keyup(function(){
      dataTablepoliticiancandidate.draw();
    });

    $('#politicianStatus').change(function(){
      dataTablepoliticiancandidate.draw();
    });
  }

// Claim Politician
  if($('#claimpoliticianTable').length){
    var dataTableclaimpolitician = $('#claimpoliticianTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': false,
      "ajax": {
        url: baseURL + "administrator/get-claim-politician",
        type: 'POST',
        'data': function(data){
          // Append to data
        
          // data.searchName = $('#searchNamepolitician').val(),
          // data.searchByStatus = $('#politicianStatus').val(),
          data.csrf_poliscore_name = $('.politiciancsrf').val()
      },complete(res){
        $('.politiciancsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'name' },
        { data: 'email' },
        { data: 'phone' },
        { data: 'driving_licince' },
        { data: 'profile_clamed' },
        { data: 'status' },
        { data: 'action' },
    ]
    } );





    // $('#searchNamepolitician').keyup(function(){
    //   dataTablepolitician.draw();
    // });

    // $('#politicianStatus').change(function(){
    //   dataTablepolitician.draw();
    // });
  }
  if($('#enqTable').length){
    //subscription
    var enqTable = $('#enqTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': true,
      
      "ajax": {
        url: baseURL + "administrator/enquiry/get",
        type: 'POST',
        'data': function(data){
          // Append to data
          data.csrf_poliscore_name = $('.enqcsrf').val()
      },complete(res){
        $('.enqcsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'name' },
        { data: 'email' },
        { data: 'phone' },
        { data: 'message' },
        { data: 'date' },
        { data: 'action' },
    ]
    } );
  }

  if($('#voteTable').length){
    var voteTable = $('#voteTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': true,
      
      "ajax": {
        url: baseURL + "administrator/votemanagement/getVotedata",
        type: 'POST',
        'data': function(data){
          data.csrf_poliscore_name = $('.votecsrf').val()
      },complete(res){
        $('.votecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'name' },
        { data: 'upcoming' },
        { data: 'status' },
        { data: 'action' },
    ]
    } );
  }

  if($('#nominateTableId').length){
    var datanominateTableId = $('#nominateTableId').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': false,
      
      "ajax": {
        url: baseURL + "administrator/get-nominate",
        type: 'POST',
        'data': function(data){
          data.csrf_poliscore_name = $('.nominatecsrf').val()
          data.searchName = $('#searchNamepolitician').val()
      },complete(res){
        $('.nominatecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'name' },
        { data: 'election_name' },
        { data: 'stae_electorate_name' },
        { data: 'action' },
    ]
    } );

    $('#searchNamepolitician').keyup(function(){
      datanominateTableId.draw();
    });
  }


  if($('#partyTable').length){
    var partyTable = $('#partyTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': true,
      
      "ajax": {
        url: baseURL + "administrator/partymanagement/getPartydata",
        type: 'POST',
        'data': function(data){
          data.csrf_poliscore_name = $('.votecsrf').val()
      },complete(res){
        $('.votecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'name' },
        { data: 'status' },
        { data: 'action' },
    ]
    } );
  }
  if($('#usersubscriptionTable').length){
    var usersubscriptionTable = $('#usersubscriptionTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': false,
      "ajax": {
        url: baseURL + "administrator/get-subscriptions",
        type: 'POST',
        'data': function(data){
          // Append to data
          data.searchName = $('#searchNamesubscriptions').val(),
          data.searchUsertype = $('#subscriptionUserType').val()
      },
      complete: function(r){
        //console.log(r)
      }
      },
      'columns': [
        { data: 'sl_no' },
        { data: 'subscription_code' },
        { data: 'payment_ref' },
        { data: 'name' },
        { data: 'role' },
        { data: 'package' },
        { data: 'amount' },
        { data: 'status' },
        { data: 'date' },
    ]
      
    } );
    $('#searchNamesubscriptions').keyup(function(){
      usersubscriptionTable.draw();
    });
    $('#subscriptionUserType').change(function(){
      usersubscriptionTable.draw();
    });
  }
  if($('#reviewTable').length){
    var partyTable = $('#reviewTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': true,
      
      "ajax": {
        url: baseURL + "politician/reviews/reviewdata",
        type: 'POST',
        'data': function(data){
          data.csrf_poliscore_name = $('.votecsrf').val()
      },complete(res){
        //console.log(res.responseJSON);
        $('.votecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'name' },
        { data: 'avgrating' },
        { data: 'review_date' },
        { data: 'action' },
    ]
    } );
  }
  if($('#surveyTable').length){
    var surveyTablePoli = $('#surveyTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': false,

      
      "ajax": {
        url: baseURL + "politician/surveyformsdata",
        type: 'POST',
        'data': function(data){
          data.csrf_poliscore_name = $('.votecsrf').val()
          data.search = $('#SearchListPoli').val(),
          data.status = $('#searchStatusPoli').val()
      },complete(res){
        console.log(res.responseJSON);
        console.log(baseURL);
        $('.votecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'name' },
        { data: 'survey_date' },
        { data: 'expiry_date' },
        { data: 'billing_code' },
        { data: 'billing_amt' },
        { data: 'status' },
        { data: 'action' },
    ]
    } );
    $('#SearchListPoli').keyup(function(){
      surveyTablePoli.draw();
    });

    $('#searchStatusPoli').change(function(){
      surveyTablePoli.draw();
    });
  }
  if($('#adminsurveyTable').length){
    var surveyTableAdminSurvey = $('#adminsurveyTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': false,
      
      "ajax": {
        url: baseURL + "administrator/surveyformsdata",
        type: 'POST',
        'data': function(data){
          data.csrf_poliscore_name = $('.votecsrf').val(),
          data.search = $('#SearchList').val(),
          data.status = $('#searchStatus').val()
      },complete(res){
        console.log(res.responseJSON);
        $('.votecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'politician' },
        { data: 'name' },
        { data: 'survey_date' },
        { data: 'expiry_date' },
        { data: 'billing_code' },
        { data: 'billing_amt' },
        { data: 'status' },
        { data: 'action' },
    ]
    } );
    $('#SearchList').keyup(function(){
      surveyTableAdminSurvey.draw();
    });

    $('#searchStatus').change(function(){
      surveyTableAdminSurvey.draw();
    });
  }
  if($('#adminindividualsurveyTable').length){
    var surveyTableAdminSurveyIndividual = $('#adminindividualsurveyTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': true,
      
      "ajax": {
        url: baseURL + "administrator/surveyformsdataindividual",
        type: 'POST',
        'data': function(data){
          data.csrf_poliscore_name = $('.votecsrf').val(),
          data.surveyid = $('#surveyId').val()
      },complete(res){
        //console.log(res.responseJSON);
        $('.votecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'politician' },
        { data: 'name' },
        { data: 'date_added' },
        { data: 'action' },
    ]
    } );
  }
  if($('#politicianindividualsurveyTable').length){
    var surveyTableAdminSurveyIndividual = $('#politicianindividualsurveyTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': true,
      
      "ajax": {
        url: baseURL + "politician/surveyformsdataindividual",
        type: 'POST',
        'data': function(data){
          data.csrf_poliscore_name = $('.votecsrf').val(),
          data.surveyid = $('#surveyId').val()
      },complete(res){
        //console.log(res.responseJSON);
        $('.votecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'politician' },
        { data: 'name' },
        { data: 'date_added' },
        { data: 'action' },
    ]
    } );
    $('#SearchList').keyup(function(){
      surveyTableAdminSurvey.draw();
    });

    $('#searchStatus').change(function(){
      surveyTableAdminSurvey.draw();
    });
  }

  if($('#adminreviewTable').length){
    var dataadminreviewTable = $('#adminreviewTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': false,
      
      "ajax": {
        url: baseURL + "administrator/reviews/reviewdata",
        type: 'POST',
        'data': function(data){
          data.csrf_poliscore_name = $('.votecsrf').val(),
          data.searchByStatus = $('#userStatus').val()
          // console.log(data.searchByStatus);
      },complete(res){
        // console.log(res.responseJSON);
        $('.votecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'name' },
        { data: 'politicianname' },
        { data: 'avgrating' },
        { data: 'review_date' },
        { data: 'active' },
        { data: 'action' },
    ]
    } );


    $('#userStatus').change(function(){
      // alert('okk');
        dataadminreviewTable.draw();
    });
  }

  if($('#abusedreviewTable').length){
    var partyTable = $('#abusedreviewTable').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': true,
      
      "ajax": {
        url: baseURL + "administrator/reviews/abusedreviewdata",
        type: 'POST',
        'data': function(data){
          data.csrf_poliscore_name = $('.votecsrf').val()
      },complete(res){
        //console.log(res.responseJSON);
        $('.votecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'sl_no' },
        { data: 'name' },
        { data: 'politicianname' },
        { data: 'avgrating' },
        { data: 'review_date' },
        { data: 'aboused_by' },
        { data: 'aboused_date' },
        { data: 'action' },
    ]
    } );
    
  }
  if($('#subscriptionTab').length){
    var subscriptionTab = $('#subscriptionTab').DataTable( {
      "processing": true,
      "serverSide": true,
      'searching': true,
      
      "ajax": {
        url: baseURL + "administrator/subscriptiondata",
        type: 'POST',
        'data': function(data){
          data.csrf_poliscore_name = $('.votecsrf').val()
      },complete(res){
        //console.log(res.responseJSON);
        $('.votecsrf').val(res.responseJSON.token)
      }

      },
      'columns': [
        { data: 'code' },
        { data: 'amount' },
        { data: 'politician' },
        { data: 'mode' },
        { data: 'date' },
    ]
    } );
  }

});
