"use strict";

$('#bien_client_typeCompte').on('change', function (e) {
  var type = e.target.value;
  $('#clientKoh').empty().append($('<option>', {
    value: '',
    text: "-- Selectionner le client --"
  }));
  document.getElementById('infoClientBanque1').innerHTML = "";
  document.getElementById('infoClientBanque2').innerHTML = "";

  if (type !== '') {
    $.ajax({
      url: '/koh_utilisateur/clients_by_type',
      type: 'post',
      dataType: 'json',
      data: {
        'type': type
      },
      success: function success(data) {
        console.log('data :: ' + JSON.stringify(data));
        $('#clientKoh').empty().append($('<option>', {
          value: '',
          text: "-- Selectionner le client mbeyan --"
        }));
        $.each(data, function (index, client) {
          $('#clientKoh').append($('<option>', {
            value: client['id'],
            text: client['email']
          }));
        });

        if ($('#bien_client_typeCompte').find(":selected").text() === 'Banque') {
          var info1 = "<div class=\"col-md-6 form-group\">\n" + "        <div class=\"form-group\">\n" + "            <label for=\"nom_client_banque\">Client de la banque</label>\n" + "            <input id=\"nom_client_banque\" type=\"text\" class=\"form-control\" name=\"nom_client_banque\" required\n" + "                   placeholder=\"nom & prénom\">\n" + "        </div>\n" + "    </div>\n" + "    <div class=\"col-md-6 form-group\">\n" + "        <div class=\"form-group\">\n" + "            <label for=\"numero_compte_client_banque\">Numero de compte client</label>\n" + "            <input id=\"numero_compte_client_banque\" type=\"text\" class=\"form-control\" name=\"numero_client_banque\"\n" + "                   required placeholder=\"compte_01_12_2020\">\n" + "        </div>\n" + "    </div>";
          var info2 = "<div class=\"col-md-6 form-group\">\n" + "        <div class=\"form-group\">\n" + "            <label for=\"contact_client_banque\">Contact du client</label>\n" + "            <input id=\"contact_client_banque\" type=\"text\" class=\"form-control\" name=\"contact_client_banque\" required\n" + "                   placeholder=\"tél ou adresse émail\">\n" + "        </div>\n" + "    </div>\n" + "    <div class=\"col-md-6 form-group\">\n" + "        <div class=\"form-group\">\n" + "            <label for=\"adresse_compte_client_banque\">Adresse du client</label>\n" + "            <input id=\"adresse_compte_client_banque\" type=\"text\" class=\"form-control\" name=\"adresse_client_banque\"\n" + "                   required placeholder=\"ville/quartier/rue\">\n" + "        </div>\n" + "    </div>";
          document.getElementById('infoClientBanque1').innerHTML = info1;
          document.getElementById('infoClientBanque2').innerHTML = info2;
        }
      }
    });
  }
});
$('#bien_client_region').on('change', function (e) {
  $('#cercle').empty();

  if (e.target.value !== '') {
    loadCercle(+e.target.value);
  }

  function loadCercle(id) {
    $.ajax({
      url: '/cercle/region_by_cercle/' + id,
      type: 'get',
      dataType: 'json',
      success: function success(data) {
        console.log('data ' + data.length);
        $('#cercle').empty().append($('<option>', {
          value: '',
          text: '-- Selectionner un cercle --'
        }));
        $.each(data, function (index, cercle) {
          $('#cercle').append($('<option>', {
            value: cercle['id'],
            text: cercle['libelle']
          }));
        });
      }
    });
  }
});
$('#cercle').on('change', function (e) {
  $('#commune').empty();

  if (e.target.value !== '') {
    loadCommune(+e.target.value);
  }

  function loadCommune(id) {
    $.ajax({
      url: '/commune/commune_by_cercle/' + id,
      type: 'get',
      dataType: 'json',
      success: function success(data) {
        $('#commune').empty().append($('<option>', {
          value: '',
          text: '-- Selectionner une commune --'
        }));
        $.each(data, function (index, commune) {
          $('#commune').append($('<option>', {
            value: commune['id'],
            text: commune['libelle']
          }));
        });
      }
    });
  }
});
$('#commune').on('change', function (e) {
  $('#quartier').empty();

  if (e.target.value !== '') {
    loadQuartier(+e.target.value);
  }

  function loadQuartier(id) {
    console.log('called !!!!');
    $.ajax({
      url: '/quartier/quartier_by_commune/' + id,
      type: 'get',
      dataType: 'json',
      success: function success(data) {
        $('#quartier').empty().append($('<option>', {
          value: '',
          text: '-- Selectionner un quartier --'
        }));
        $.each(data, function (index, quartier) {
          console.log('id :: ' + quartier['libelle']);
          $('#quartier').append($('<option>', {
            value: quartier['id'],
            text: quartier['libelle']
          }));
        });
      }
    });
  }
});
$('#bien_client_typeDocument').on('change', function () {
  var type = $('#bien_client_typeDocument').find(":selected").text();
  document.getElementById('infoFoncier').innerHTML = "";

  if (type.toLowerCase() === 'titre foncier') {
    document.getElementById('infoFoncier').innerHTML = "<div class=\"col-md-6 form-group\">\n" + "        <div class=\"form-group\">\n" + "            <label for=\"volume_foncier\">Volume</label>\n" + "            <input type=\"text\" class=\"form-control\" name=\"volume_foncier\" id=\"volume_foncier\">\n" + "        </div>\n" + "    </div>\n" + "    <div class=\"col-md-6 form-group\">\n" + "        <div class=\"form-group\">\n" + "            <label for=\"f_foncier\">F</label>\n" + "            <input type=\"text\" class=\"form-control\" name=\"foncier_f\" id=\"f_foncier\">\n" + "        </div>\n" + "    </div>";
  }
});
$('#bien_client_typeAcquisition').on('change', function () {
  var type = $('#bien_client_typeAcquisition').find(":selected").text();
  document.getElementById('formAdjuction').innerHTML = "";

  if (type.toLowerCase() === 'IHE Adjudiction'.toLowerCase()) {
    document.getElementById('formAdjuction').innerHTML = "<div class=\"col-md-4 form-group\">\n" + "        <div class=\"form-group\">\n" + "            <label for=\"date_entree\">Date entrée</label>\n" + "            <input type=\"date\" class=\"form-control\" name=\"date_entree\" id=\"date_entree\">\n" + "        </div>\n" + "    </div>\n" + "    <div class=\"col-md-4 form-group\">\n" + "        <div class=\"form-group\">\n" + "            <label for=\"montant_acquisition\">Montant acquisition</label>\n" + "            <input type=\"number\" class=\"form-control\" name=\"montant_acquisition\" id=\"montant_acquisition\">\n" + "        </div>\n" + "    </div>\n" + "    <div class=\"col-md-4 form-group\">\n" + "        <div class=\"form-group\">\n" + "            <label for=\"frais_acquisition\">Frais acquisition</label>\n" + "            <input type=\"number\" id=\"frais_acquisition\" name=\"frais_acquisition\" class=\"form-control\">\n" + "        </div>\n" + "    </div>";
  }
});
$('#quartier').on('change', function (e) {
  if (e.target.value !== '') {
    var quartier = e.target.value;
    var cercle = $('#cercle').find(":selected").text();
    loadMap(quartier, cercle);
  }

  function loadMap(quartier, cercle) {
    var str = 'https://maps.googleapis.com/maps/api/geocode/json?address=' + quartier + ',' + cercle + ',Mali&key=AIzaSyCo18VhOGOgmI7qIKBjSB5kq9tJYp5HWEE';
    var url = encodeURI(str);
    $.ajax({
      url: url,
      datatype: 'json',
      type: 'get',
      success: function success(data) {
        if (data.status === 'OK') {
          "use strict";

          var i = 0;
          var _iteratorNormalCompletion = true;
          var _didIteratorError = false;
          var _iteratorError = undefined;

          try {
            for (var _iterator = data.results[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
              var d = _step.value;

              if (i === 0) {
                initMap(d);
                document.getElementById('map').style.width = '100%';
                document.getElementById('map').style.height = '400px';
                document.getElementById('map').classList.add('mt-3');
                document.getElementById('map').classList.add('mb-3');
                document.getElementById('quartier_latitude_hidden').value = d.geometry.location.lat;
                document.getElementById('quartier_longitude_hidden').value = d.geometry.location.lng;
              }

              i++;
            }
          } catch (err) {
            _didIteratorError = true;
            _iteratorError = err;
          } finally {
            try {
              if (!_iteratorNormalCompletion && _iterator["return"] != null) {
                _iterator["return"]();
              }
            } finally {
              if (_didIteratorError) {
                throw _iteratorError;
              }
            }
          }
        } else {
          alert('Impossible de trouver les coordonnées');
          document.getElementById('quartier').value = '';
          "use strict";

          initMap(null);
        }
      }
    });
  }
});

function initMap(d) {
  if (d === null || d === undefined) {
    new google.maps.Map(document.getElementById("map"), {
      center: {
        lat: 0,
        lng: 0
      },
      zoom: 8,
      mapTypeControlOptions: {
        mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain', 'styled_map']
      }
    });
    document.getElementById('map').style.width = '0';
    document.getElementById('map').style.height = '0';
    document.getElementById('map').classList.remove('mt-3');
    document.getElementById('map').classList.remove('mb-3');
    document.getElementById('quartier_latitude_hidden').value = '';
    document.getElementById('quartier_longitude_hidden').value = '';
  } else {
    new google.maps.Map(document.getElementById("map"), {
      center: {
        lat: d.geometry.location.lat,
        lng: d.geometry.location.lng
      },
      zoom: 15,
      mapTypeControlOptions: {
        mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain', 'styled_map']
      }
    });
  }
}

$(document).ready(function () {
  var i = 1;
  var j = 1;
  var k = 1;
  var l = 1;
  $('#addImage').on('click', function () {
    i++;
    $('#form_image').append('<div id=\'form-row-image' + i + '\' class="form-row align-items-end">\n' + '        <div class="col-md-10">\n' + '            <div class="form-group">\n' + '                <label for="">Photo ' + i + '</label>\n' + '                <input type="file" class="form-control" name="document_image' + i + '">\n' + '            </div>\n' + '        </div>\n' + '        <div class="col-md-1">\n' + '            <div class="form-group">\n' + '                <button type="button" id=\'' + i + '\' class="btn btn-danger removeImage"><i class="fa fa-remove"></i></button>\n' + '            </div>\n' + '        </div>\n' + '    </div>');
  });
  $(document).on('click', '.removeImage', function () {
    var btn = $(this).attr('id');
    document.getElementById('form-row-image' + btn).innerHTML = "";
  });
  $('#addProprietePdf').on('click', function () {
    j++;
    $('#form_propriete_pdf').append('<div class="form-row align-items-end" id="form-row-pdf' + j + '">\n' + '        <div class="col-md-10">\n' + '            <div class="form-group">\n' + '                <label for="">Document proprieté pdf ' + j + '</label>\n' + '                <input type="file" name="document_propriete_pdf' + j + '" class="form-control">\n' + '            </div>\n' + '        </div>\n' + '        <div class="col-md-1">\n' + '            <div class="form-group">\n' + '                <button class="btn btn-danger removeProprietePdf" id="' + j + '" ><i class="fa fa-remove"></i></button>\n' + '            </div>\n' + '        </div>\n' + '    </div>');
  });
  $(document).on('click', '.removeProprietePdf', function () {
    var btn = $(this).attr('id');
    document.getElementById('form-row-pdf' + btn).innerHTML = "";
  });
  $('#addExpertisePdf').on('click', function () {
    k++;
    $('#form_expertise_pdf').append('<div class="form-row align-items-end" id=\"form-row-expert' + k + '\">\n' + '        <div class="col-md-10">\n' + '            <div class="form-group">\n' + '                <label for="">Document expertise pdf ' + k + '</label>\n' + '                <input type="file" class="form-control" name="document_expertise_pdf' + k + '">\n' + '            </div>\n' + '        </div>\n' + '        <div class="col-md-1">\n' + '            <div class="form-group">\n' + '                <button type="button" id="' + k + '" class="btn btn-danger removeExpertisePdf"><i class="fa fa-remove"></i></button>\n' + '            </div>\n' + '        </div>\n' + '    </div>');
  });
  $(document).on('click', '.removeExpertisePdf', function () {
    var btn = $(this).attr('id');
    document.getElementById('form-row-expert' + btn).innerHTML = "";
  });
  $('#addOtherDoc').on('click', function () {
    l++;
    $('#form_other').append('<div class="form-row align-items-end" id=\"form-row-other' + l + '\">\n' + '        <div class="col-md-10">\n' + '            <div class="form-group">\n' + '                <label for="">Autre document ' + l + '</label>\n' + '                <input type="file" class="form-control" name="document_other' + l + '">\n' + '            </div>\n' + '        </div>\n' + '        <div class="col-md-1">\n' + '            <div class="form-group">\n' + '                <button type="button" id="' + l + '" class="btn btn-danger removeOtherDoc"><i class="fa fa-remove"></i></button>\n' + '            </div>\n' + '        </div>\n' + '    </div>');
  });
  $(document).on('click', '.removeOtherDoc', function () {
    var btn = $(this).attr('id');
    document.getElementById('form-row-other' + btn).innerHTML = "";
  });
});