$(document).ready(function() {
    const currentMonthElement = $('#currentMonth');
    const currentGradeNameElement = $('#currentGradeName');
    const curriculumListContainer = $('#curriculumList');
    const currentMonthHidden = $('#currentMonthHidden');

    let currentMonth = currentMonthHidden.val();
    let currentGradeId = currentGradeNameElement.data('grade-id');

    $('#prevMonth').on('click', function() {
        changeMonth('prev');
    });

    $('#nextMonth').on('click', function() {
        changeMonth('next');
    });

    $('.changeGrade').on('click', function() {
        const gradeId = $(this).data('grade-id');
        changeGrade(gradeId);
    });

    function changeMonth(direction) {
        console.log('direction:', direction);
        console.log('currentMonth:', currentMonth);
        console.log('currentGradeId:', currentGradeId);
        const url = `/EducationSystem/user/curriculum_list/change-month/${direction}?month=${currentMonth}&grade=${currentGradeId}`;
        console.log('Generated URL:', url);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                const tempDiv = $('<div>').html(data);
                const newCurriculumList = tempDiv.find('#curriculumList').html();
                const newMonth = tempDiv.find('#currentMonth').text();
                curriculumListContainer.html(newCurriculumList);
                currentMonthElement.text(newMonth);

                const newMonthHiddenVal = tempDiv.find('#currentMonthHidden').val();
                currentMonth = newMonthHiddenVal;
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function changeGrade(gradeId) {
        const url = `/EducationSystem/user/curriculum_list?grade=${gradeId}&month=${currentMonth}`;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                const tempDiv = $('<div>').html(data);
                const newCurriculumList = tempDiv.find('#curriculumList').html();
                const newGradeName = tempDiv.find('#currentGradeName').text();
                const newGradeId = tempDiv.find('#currentGradeName').data('grade-id');
                curriculumListContainer.html(newCurriculumList);
                currentGradeNameElement.text(newGradeName);
                currentGradeNameElement.data('grade-id', newGradeId);

                const allGradeButtons = $('.changeGrade');
                allGradeButtons.removeClass('btn-info btn-primary btn-success');
                allGradeButtons.each(function() {
                    const btnGradeId = parseInt($(this).data('grade-id'));
                    let btnClass;
                    if (btnGradeId <= 6) {
                        btnClass = 'btn-info';
                    } else if (btnGradeId <= 9) {
                        btnClass = 'btn-primary';
                    } else if (btnGradeId <= 12) {
                        btnClass = 'btn-success';
                    }
                    $(this).addClass(btnClass);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }
});