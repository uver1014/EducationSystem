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
        const url = `/EducationSystem/user/curriculum_list/change-month/${direction}?month=${currentMonth}&grade=${currentGradeId}`;
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

    // function changeGrade(gradeId) {
    //     const url = `/EducationSystem/user/curriculum_list?grade=${gradeId}&month=${currentMonth}`;
    //     $.ajax({
    //         url: url,
    //         type: 'GET',
    //         dataType: 'html',
    //         success: function(data) {
    //             const tempDiv = $('<div>').html(data);
    //             const newCurriculumList = tempDiv.find('#curriculumList').html();
    //             const newGradeNameElement = tempDiv.find('#currentGradeName');
    //             const newGradeName = newGradeNameElement.text();
    //             const newGradeId = newGradeNameElement.data('grade-id');
    //             curriculumListContainer.html(newCurriculumList);
    //             currentGradeNameElement.text(newGradeName);
    //             currentGradeNameElement.data('grade-id', newGradeId);

    //             // 学年表示の色を更新
    //             let currentGradeBtnClass;
    //             if (newGradeId <= 6) {
    //                 currentGradeBtnClass = 'btn-grade-elementary';
    //             } else if (newGradeId <= 9) {
    //                 currentGradeBtnClass = 'btn-grade-middle';
    //             } else if (newGradeId <= 12) {
    //                 currentGradeBtnClass = 'btn-grade-high';
    //             }
    //             currentGradeNameElement.removeClass('btn-info btn-primary btn-success btn-grade-elementary btn-grade-middle btn-grade-high').addClass(currentGradeBtnClass);

    //             // 学年切り替えボタンの色を更新
    //             const allGradeButtons = $('.changeGrade');
    //             allGradeButtons.removeClass('btn-info btn-primary btn-success btn-grade-elementary btn-grade-middle btn-grade-high');
    //             allGradeButtons.each(function() {
    //                 const btnGradeId = parseInt($(this).data('grade-id'));
    //                 let btnClass;
    //                 if (btnGradeId <= 6) {
    //                     btnClass = 'btn-grade-elementary';
    //                 } else if (btnGradeId <= 9) {
    //                     btnClass = 'btn-grade-middle';
    //                 } else if (btnGradeId <= 12) {
    //                     btnClass = 'btn-grade-high';
    //                 }
    //                 $(this).addClass(btnClass);
    //             });
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error fetching data:', error);
    //         }
    //     });
    // }
    function changeGrade(gradeId) {
        const url = `/EducationSystem/user/curriculum_list?grade=${gradeId}&month=${currentMonth}`;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                const tempDiv = $('<div>').html(data);
                const newCurriculumList = tempDiv.find('#curriculumList').html();
                const newGradeNameElement = tempDiv.find('#currentGradeName');
                const newGradeName = newGradeNameElement.text();
                const newGradeId = newGradeNameElement.data('grade-id');
                curriculumListContainer.html(newCurriculumList);
                currentGradeNameElement.text(newGradeName);
                currentGradeNameElement.data('grade-id', newGradeId);
    
                // 学年表示の色を更新
                let currentGradeBtnClass;
                if (newGradeId <= 6) {
                    currentGradeBtnClass = 'btn-grade-elementary';
                } else if (newGradeId <= 9) {
                    currentGradeBtnClass = 'btn-grade-middle';
                } else if (newGradeId <= 12) {
                    currentGradeBtnClass = 'btn-grade-high';
                }
                // 既存の学年色クラスを削除してから新しいクラスを追加
                currentGradeNameElement.removeClass('btn-info btn-primary btn-success btn-grade-elementary btn-grade-middle btn-grade-high').addClass(currentGradeBtnClass);
    
                // 学年切り替えボタンの色を更新
                const allGradeButtons = $('.changeGrade');
                allGradeButtons.removeClass('btn-info btn-primary btn-success btn-grade-elementary btn-grade-middle btn-grade-high');
                allGradeButtons.each(function() {
                    const btnGradeId = parseInt($(this).data('grade-id'));
                    let btnClass;
                    if (btnGradeId <= 6) {
                        btnClass = 'btn-grade-elementary';
                    } else if (btnGradeId <= 9) {
                        btnClass = 'btn-grade-middle';
                    } else if (btnGradeId <= 12) {
                        btnClass = 'btn-grade-high';
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