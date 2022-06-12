num1=int(input('Enter first number: '))
num2=int(input('Enter  second number: '))
op=input('Enter Operator')

if op=='+':
    print('The sum is ',num1+num2)
elif op=='-':
    print('The difference is ',num1-num2)
elif op=='/':
    print('The quotient is ',num1/num2)
elif op=='*':
    print('The product is ',num1*num2)
elif op=='%':
    print('The remainder is ',num1%num2)
else:
        print('Invalid Operator')
