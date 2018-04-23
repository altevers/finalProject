SELECT *
FROM users
WHERE 
    nkuID = :nkuID AND
    password = :password;