<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api blog</title>
</head>
<body>
    Chào mừng đến với apiLunaBlog
    <br>
    GET http://127.0.0.1:8000/post/show  <strong> ----để lấy toàn bộ bài viết</strong>
    <br>
    GET http://127.0.0.1:8000/post/show?title={title} <strong>---để tìm kiếm bài viết theo title</strong>
    <br>
    GET http://127.0.0.1:8000/post/show?id={id} <strong>---để tìm kiếm bài viết theo id</strong>
    <br>
    GET http://127.0.0.1:8000/post/delete?id={id} <strong>---xóa theo id /// cần đăng nhập lấy chuỗi token gửi qua header : 'Bearer' + {chuỗi token}</strong>
    <br> 
    POST http://127.0.0.1:8000/post/update <strong>---update post qua body gồm các thuộc tính: username,title,content,image /// cần đăng nhập lấy chuỗi token gửi qua header : 'Bearer' +{chuỗi token}</strong>
    <br>
    POST http://127.0.0.1:8000/post/create <strong>---tạo post qua body gồm các thuộc tính: username,title,content,image /// cần đăng nhập lấy chuỗi token gửi qua header : 'Bearer' +{chuỗi token}</strong>
    <br>
    <hr>
    POST http://127.0.0.1:8000/auth/register <strong>---đăng kí tài khoản qua body :  username,email,password, </strong>  
    <br>
    POST http://127.0.0.1:8000/auth/login <strong>---đăng nhập tài khoản qua body :  email,password---thành công sẽ trả về chuỗi token </strong>  
    <br>
</body>
</html>