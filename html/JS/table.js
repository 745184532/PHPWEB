//新增数据函数
function addROW () {
    var table = document.getElementById('table');
    // console.log(table)
    //获取插入的位置
    var length = table.rows.length;
    // console.log(length)
    //插入行节点
    var newRow = table.insertRow(length)
    // console.log(newRow)
    //插入行节点对象
    var nameCol =newRow.insertCell(0)
    var phoneCol =newRow.insertCell(1)
    var actionCol =newRow.insertCell(2)
    //修改节点文本内容
    nameCol.innerHTML = '未命名';
    phoneCol.innerHTML = '无联系方式';
    actionCol.innerHTML = '<button onclick="editRow(this)">修改</button>' +
                          '<button onclick="deleteRow(this)">删除</button>';
}
//删除数据
function deleteRow(button) {
    //删除行
    // console.log(button)
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
//编辑数据
function editRow(button) {
    var row = button.parentNode.parentNode;
    var name = row.cells[0];
    var phone = row.cells[1];

    inputName = prompt('请输入新的姓名', name.innerHTML);
    inputPhone = prompt('请输入新的电话号码', phone.innerHTML);

}