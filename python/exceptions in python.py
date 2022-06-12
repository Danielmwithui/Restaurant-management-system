try:
    x=int(input('Input an integer'))
    print(x)
except:
    print('Something went wrong ....Try again')
else:
    print('Nothing went wrong')
finally:
    print('try except finished')
   