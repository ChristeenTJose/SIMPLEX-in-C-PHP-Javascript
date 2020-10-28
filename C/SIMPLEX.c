#include<stdio.h>
#include<stdlib.h>
#define size 50
void main()
{
    float M[size][size],temp;
    int m,n,i,j,flag,k=0,round=1;
    int pivot_column,pivot_row;
    printf("Enter the number of constraints: ");
    scanf("%d",&m);
    printf("Enter the number of variables: ");
    scanf("%d",&n);
    for(i=0;i<(m+1);i++)
    {
        for(j=0;j<(n+m+2);j++)
        {
            M[i][j]=0;
        }
    }
    for(i=0;i<m;i++)
    {
        for(j=0;j<n;j++)
        {
            printf("\nEnter the coefficient of x%d in constraint%d: ",j+1,i+1);
            scanf("%f",&M[i][j]);
        }
        printf("\nEnter the value of constant term in constraint%d: ",i+1);
        scanf("%f",&M[i][m+n+1]);
        printf("\n");
    }
    for(i=0;i<n;i++)//Checking whether at least one non-zero value exists for each variable
    {
        flag=0;
        for(j=0;j<m;j++)
        if(M[j][i]!=0)
        flag=1;
        if(flag==0)
        {
            printf("\n\n\n\t\tInvalid set of inputs (no non-zero coefficient values found for x%d )\n\n",i+1);
            system("pause");
            exit(1);
        }
    }
    printf("\n\nOptimisation objective:");
    for(i=0;i<n;i++)
    {
        printf("\nEnter the coefficient of x%d in optimisation objective: ",i+1);
        scanf("%f",&M[m][i]);
    }
    for(i=0;i<=m;i++)
    {
       M[i][n+k]=1;
       k++;
    }
    for(i=0;i<=m;i++)
    {
        for(j=0;j<=(n+m+1);j++)
        {
            printf("\t%.2f",M[i][j]);
        }
        printf("\n");
    }
    do
    {
        printf("\n\n=====Round: %d=====",round);
        pivot_column=0;
        for(i=0;i<n;i++)
        {
            if(M[m][i]<M[m][pivot_column])
            pivot_column=i;
        }
        printf("\nPivot Column = %d",i+1);
        pivot_row=0;
        for(i=0;i<m;i++)
        {
            if((M[i][m+n+1]/M[i][pivot_column])<(M[pivot_row][m+n+1]/M[pivot_row][pivot_column]))
            pivot_row=i;
        }
        printf("\tPivot Row = %d",i+1);
        printf("\nPivot element = %d",M[pivot_row][pivot_column]);
        if(M[pivot_row][pivot_column]!=1 && M[pivot_row][pivot_column]!=-1)
        {
            temp=M[pivot_row][pivot_column];
            for(i=0;i<=(m+n+1);i++)
            {
                M[pivot_row][i]/=temp;
            }
            for(i=0;i<=m;i++)
            {
                temp=M[i][pivot_column];
                if(i==pivot_row)
                continue;
                for(j=0;j<=m+n+1;j++)
                {
                    M[i][j]-=(temp*M[pivot_row][j]);
                }
            }
        }
        k=0;
        for(i=0;i<n;i++)
        {
            if(M[m][i]>=0)
            k++;
        }
        printf("\nIntermediate Result: \n");
        for(i=0;i<=m;i++)
        {
            for(j=0;j<=(n+m+1);j++)
            {
                printf("\t%.2f",M[i][j]);
            }
            printf("\n");
        }
        round+=1;
    }
    while(k<n);
    printf("\n\n\n=======RESULT=======\n");
    for(i=0;i<=m;i++)
        {
            for(j=0;j<=(n+m+1);j++)
            {
                printf("\t%.2f",M[i][j]);
            }
            printf("\n");
        }
    printf("\n\n\t\tOptimal value: %.2f",M[m][m+n+1]);
    for(i=0;i<m;i++)
    {
        printf("\n\t\tX%d: %.2f",i+1,M[i][m+n+1]);
    }
    printf("\n");
    system("pause");
}
